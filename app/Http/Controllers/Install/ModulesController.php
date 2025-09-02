<?php

namespace App\Http\Controllers\Install;

use App\Http\Controllers\Controller;
use App\Utils\ModuleUtil;
use Illuminate\Http\Request;
use Module;
use ZipArchive;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\NullOutput;
use Illuminate\Support\Facades\Log;
class ModulesController extends Controller
{
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param  ModuleUtil  $moduleUtil
     * @return void
     */
    public function __construct(ModuleUtil $moduleUtil)
    {
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! auth()->user()->can('manage_modules')) {
            abort(403, 'Unauthorized action.');
        }
        Artisan::call('cache:clear');
        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (! empty($notAllowed)) {
            return $notAllowed;
        }

        //Get list of all modules.
        $modules = Module::toCollection()->toArray();

        foreach ($modules as $module => $details) {
            $modules[$module]['is_installed'] = $this->moduleUtil->isModuleInstalled($details['name']) ? true : false;

            //Get version information.
            if ($modules[$module]['is_installed']) {
                $modules[$module]['version'] = $this->moduleUtil->getModuleVersionInfo($details['name']);
            }

            //Install Link.
            try {
                $modules[$module]['install_link'] = action('\Modules\\'.$details['name'].'\Http\Controllers\InstallController@index');
            } catch (\Exception $e) {
                $modules[$module]['install_link'] = '#';
            }

            //Update Link.
            try {
                $modules[$module]['update_link'] = action('\Modules\\'.$details['name'].'\Http\Controllers\InstallController@update');
            } catch (\Exception $e) {
                $modules[$module]['update_link'] = '#';
            }

            //Uninstall Link.
            try {
                $modules[$module]['uninstall_link'] = action('\Modules\\'.$details['name'].'\Http\Controllers\InstallController@uninstall');
            } catch (\Exception $e) {
                $modules[$module]['uninstall_link'] = '#';
            }
        }

        $is_demo = (config('app.env') == 'demo');
        $mods = $this->__available_modules();

        return view('install.modules.index')
            ->with(compact('modules', 'is_demo', 'mods'));

        //Option to uninstall

        //Option to activate/deactivate

        //Upload module.
    }

    public function regenerate(Request $request)
{
    // 1) Permissions check
    if (! auth()->user()->can('manage_modules')) {
        abort(403, 'Unauthorized action.');
    }

    $notAllowed = $this->moduleUtil->notAllowedInDemo();
    if (! empty($notAllowed)) {
        return $notAllowed;
    }

    if (! defined('Symfony\Component\Console\Helper\STDIN')) {
        define(
            'Symfony\Component\Console\Helper\STDIN',
            // create a PHP input stream resource for STDIN
            fopen('php://stdin', 'r')
        );
    }

    try {
        Artisan::call('module:publish', [], new NullOutput());
        Artisan::call('passport:install', ['--force' => true], new NullOutput());
        // Artisan::call('scribe:generate', [], new NullOutput());

        $output = [
            'success' => 1,
            'msg'     => __('lang_v1.success'),
        ];
    } catch (\Exception $e) {
        Log::error("Error in regenerate(): " . $e->getMessage());
        $output = [
            'success' => 0,
            'msg'     => $e->getMessage(),
        ];
    }
    return redirect()->back()->with('status', $output);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Activate/Deaactivate the specified module.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $module_name)
    {
        if (! auth()->user()->can('manage_modules')) {
            abort(403, 'Unauthorized action.');
        }
        Artisan::call('cache:clear');

        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (! empty($notAllowed)) {
            return $notAllowed;
        }

        try {
            $module = Module::find($module_name);

            //php artisan module:disable Blog
            if ($request->action_type == 'activate') {
                $module->enable();
            } elseif ($request->action_type == 'deactivate') {
                $module->disable();
            }

            $output = ['success' => true,
                'msg' => __('lang_v1.success'),
            ];
        } catch (\Exception $e) {
            $output = ['success' => false,
                'msg' => $e->getMessage(),
            ];
        }

        return redirect()->back()->with(['status' => $output]);
    }

    /**
     * Deletes the module.
     *
     * @param  string  $module_name
     * @return \Illuminate\Http\Response
     */
    public function destroy($module_name)
    {
        if (! auth()->user()->can('manage_modules')) {
            abort(403, 'Unauthorized action.');
        }
        Artisan::call('cache:clear');

        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (! empty($notAllowed)) {
            return $notAllowed;
        }

        try {
            $module = Module::find($module_name);
            // $module->delete();

            $path = $module->getPath();

            die("To delete the module delete this folder <br/>" . $path . '<br/> Go back after deleting');

            $output = ['success' => true,
                'msg' => __('lang_v1.success'),
            ];
        } catch (\Exception $e) {
            $output = ['success' => false,
                'msg' => $e->getMessage(),
            ];
        }

        return redirect()->back()->with(['status' => $output]);
    }

    /**
     * Upload the module.
     */
    public function uploadModule(Request $request)
    {
        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (! empty($notAllowed)) {
            return $notAllowed;
        }
        Artisan::call('cache:clear');
        try {

            //get zipped file
            $module = $request->file('module');
            $module_name = $module->getClientOriginalName();
            $module_name = str_replace('.zip', '', $module_name);

            //check if uploaded file is valid or not and and if not redirect back
            if ($module->getMimeType() != 'application/zip') {
                $output = ['success' => false,
                    'msg' => __('lang_v1.pls_upload_valid_zip_file'),
                ];

                return redirect()->back()->with(['status' => $output]);
            }

            //check if 'Modules' folder exist or not, if not exist create
            $path = '../Modules';
            if (! is_dir($path)) {
                mkdir($path, 0777, true);
            }

            //extract the zipped file in given path
            $zip = new ZipArchive();
            if ($zip->open($module) === true) {
                $zip->extractTo($path.'/');
                $zip->close();

                //Needs improvement

                // if(!(file_exists($path . '/' . $module_name . '/composer.json')
                //     && file_exists($path . '/' . $module_name . '/module.json')
                //     && file_exists($path . '/' . $module_name . '/Config/config.php'))){
                //         \File::deleteDirectory($path . '/' . $module_name);
                // }
            }

            $output = ['success' => true,
                'msg' => __('lang_v1.success'),
            ];
        } catch (Exception $e) {
            $output = ['success' => false,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return redirect()->back()->with(['status' => $output]);
    }
    private function __available_modules()
    {
        return [
            [
                "n" => "Essentials",
                "dn" => "Essentials Module",
                "u" => "https://bardpos.com/essential-app",
                "d" => "Essentials features for every growing business."
            ],
            [
                "n" => "Superadmin",
                "dn" => "Superadmin Module",
                "u" => "https://bardpos.com/superadmin-app",
                "d" => "Turn your POS into a SaaS application and start earning by selling subscriptions."
            ],
            [
                "n" => "Woocommerce",
                "dn" => "Woocommerce Module",
                "u" => "https://bardpos.com/woocommerce-app",
                "d" => "Sync your Woocommerce store with POS."
            ],
            [
                "n" => "Manufacturing",
                "dn" => "Manufacturing Module",
                "u" => "https://bardpos.com/manufacturing-app",
                "d" => "Manufacture products from raw materials, organize recipes & ingredients."
            ],
            [
                "n" => "Project",
                "dn" => "Project Module",
                "u" => "https://bardpos.com/project-app",
                "d" => "Manage Projects, tasks, task time logs, activities, and much more."
            ],
            [
                "n" => "Repair",
                "dn" => "Repair Module",
                "u" => "https://bardpos.com/repair-app",
                "d" => "Repair module helps with complete repair service management of electronic goods like Cellphone, Computers, Desktops, Tablets, Television, Watch, Wireless devices, Printers, Electronic instruments, and many more similar devices that you can imagine!"
            ],
            [
                "n" => "Crm",
                "dn" => "CRM Module",
                "u" => "https://bardpos.com/crm-module-for-bardpos",
                "d" => "Customer relationship management module."
            ],
            [
                "n" => "ProductCatalogue",
                "dn" => "ProductCatalogue",
                "u" => "https://bardpos.com/digital-product-catalogue-menu-module-for-bardpos",
                "d" => "Digital Product catalogue Module."
            ],
            [
                "n" => "Accounting",
                "dn" => "Accounting Module",
                "u" => "https://bardpos.com/accounting-bookkeeping-module-for-bardpos",
                "d" => "Accounting & Bookkeeping module for BardPOS."
            ],
            [
                "n" => "AiAssistance",
                "dn" => "AiAssistance Module",
                "u" => "https://bardpos.com/ai-assistance-module-for-bardpos",
                "d" => "AI Assistant module for BardPOS. This module uses the openAI API to help with copywriting & reporting."
            ],
            [
                "n" => "AssetManagement",
                "dn" => "AssetManagement Module",
                "u" => "https://bardpos.com/asset-management-module-for-bardpos",
                "d" => "Useful for managing all kinds of assets."
            ],
            [
                "n" => "Cms",
                "dn" => "Cms Module",
                "u" => "https://bardpos.com/bardpos-cms-module",
                "d" => "Mini CMS (content management system) Module for BardPOS to help manage all frontend contents like Landing page, Blogs, Contact us & many other pages."
            ],
            [
                "n" => "Connector",
                "dn" => "Connector/API Module",
                "u" => "https://bardpos.com/rest-api-module-for-bardpos",
                "d" => "Provide the API for POS."
            ],
            [
                "n" => "Spreadsheet",
                "dn" => "Spreadsheet Module",
                "u" => "https://bardpos.com/spreadsheet-module-for-bardpos",
                "d" => "Allows you to create spreadsheets and share them with employees, roles & to-dos."
            ]
        ];
    }
    
}
