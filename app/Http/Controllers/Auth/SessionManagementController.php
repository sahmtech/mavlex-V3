<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Business;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Utils\ModuleUtil;
use App\Utils\Util;
use DB;
use Illuminate\Support\Facades\Session as SessionFacade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;



class SessionManagementController extends Controller
{
    protected $moduleUtil;
    protected $util;

    public function __construct(ModuleUtil $moduleUtil, Util $util)
    {
        $this->moduleUtil = $moduleUtil;
        $this->util = $util;
    }

    private function getSessionDriver()
    {
        return config('session.driver');
    }

    private function getActiveSessions()
    {
        $driver = $this->getSessionDriver();
       
        if ($driver === 'database') {
            return $this->getDatabaseSessions();
        } elseif ($driver === 'file') {
            $sessions = $this->getFileSessions();
            return $sessions;
        }

        return collect();
    }

    private function getDatabaseSessions()
    {
        $sessions = DB::table('sessions')
            ->whereNotNull('user_id')
            ->select('id', 'user_id', 'ip_address', 'user_agent', 'last_activity', 'payload')
            ->get();

        return $sessions->map(function ($session) {
            $currentPage = null;
            
            if ($session->payload) {
                try {
                    $decodedPayload = base64_decode($session->payload);
                    $sessionData = @unserialize($decodedPayload);
                    
                    if ($sessionData && isset($sessionData['_previous']['url'])) {
                        $currentPage = $this->extractPageFromUrl($sessionData['_previous']['url']);
                    }
                } catch (\Exception $e) {
                }
            }
            
            $session->current_page = $currentPage;
            return $session;
        });
    }


    private function getFileSessions()
    {
        $sessionPath = config('session.files');
      
        $sessions = collect();

        if (!File::exists($sessionPath)) {
            return $sessions;
        }

        $files = File::files($sessionPath);

        foreach ($files as $file) {
            try {
                $content = File::get($file->getPathname());
                $sessionData = $this->parseFileSession($content);

                if ($sessionData && !empty($sessionData['user_id'])) {
                    $additionalInfo = $this->extractRequestInfoFromSession($content);

                    $sessions->push((object) [
                        'id' => $file->getFilenameWithoutExtension(),
                        'user_id' => $sessionData['user_id'],
                        'ip_address' => $sessionData['ip_address'] ?? $additionalInfo['ip_address'] ?? null,
                        'user_agent' => $sessionData['user_agent'] ?? $additionalInfo['user_agent'] ?? null,
                        'current_page' => $sessionData['current_page'] ?? $additionalInfo['current_page'] ?? null,
                        'last_activity' => $file->getMTime(),
                    ]);
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        return $sessions;
    }

    private function extractRequestInfoFromSession($content)
    {
        $ipAddress = null;
        $userAgent = null;
        $currentPage = null;

        try {
            $data = @unserialize($content);
            if ($data && is_array($data)) {
                if (isset($data['_previous']['url'])) {
                    $currentPage = $this->extractPageFromUrl($data['_previous']['url']);
                    $ipAddress = $data['_previous']['ip'] ?? null;
                }

                if (isset($data['_sf2_attributes'])) {
                    $sf2 = $data['_sf2_attributes'];
                    $ipAddress = $sf2['_request_ip'] ?? $ipAddress;
                    $userAgent = $sf2['_request_user_agent'] ?? $userAgent;
                }
            }
        } catch (\Exception $e) {
            if (preg_match('/REMOTE_ADDR["\'].*?["\']([^"\']+)/', $content, $matches)) {
                $ipAddress = $matches[1];
            }
            if (preg_match('/HTTP_USER_AGENT["\'].*?["\']([^"\']+)/', $content, $matches)) {
                $userAgent = $matches[1];
            }
            if (preg_match('/"_previous".*?"url".*?"([^"]+)"/', $content, $matches)) {
                $currentPage = $this->extractPageFromUrl($matches[1]);
            }
        }

        return [
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'current_page' => $currentPage,
        ];
    }
    
    private function extractPageFromUrl($url)
    {
        if (empty($url)) return null;
        
        $path = parse_url($url, PHP_URL_PATH);
        if (!$path) return null;
        
        $cleanPath = str_replace('/app/', '/', $path);
        
        $segments = array_filter(explode('/', trim($cleanPath, '/')));
        
        if (empty($segments)) {
            $pageName = 'Dashboard';
        } else {
            $mainSegment = $segments[0];
            
            $pageMap = [
                'home' => 'Dashboard',
                'business' => 'Business',
                'contacts' => 'Contacts',
                'products' => 'Products',
                'purchases' => 'Purchases', 
                'sells' => 'Sales',
                'pos' => 'POS',
                'stock-transfers' => 'Stock Transfers',
                'stock-adjustments' => 'Stock Adjustments',
                'expenses' => 'Expenses',
                'reports' => 'Reports',
                'settings' => 'Settings',
                'users' => 'Users',
                'roles' => 'Roles',
                'session-management' => 'Session Management',
                'app-settings' => 'App Settings',
            ];
            
            $pageName = $pageMap[$mainSegment] ?? ucwords(str_replace(['-', '_'], ' ', $mainSegment));
        }
        
        return [
            'name' => $pageName,
            'url' => $url
        ];
    }
    
   
    private function parseFileSession($content)
    {
        try {
            $data = @unserialize($content);
            if ($data !== false && is_array($data)) {
                return $this->extractUserDataFromSessionArray($data);
            }

            return $this->extractUserDataViaRegex($content);
        } catch (\Exception $e) {
            return null;
        }
    }

    private function extractUserDataFromSessionArray($data)
    {
        $userId = null;
        $ipAddress = null;
        $userAgent = null;
        $currentPage = null;

        if (isset($data['_previous']['url'])) {
            $currentPage = $this->extractPageFromUrl($data['_previous']['url']);
            $ipAddress = $data['_previous']['ip'] ?? null;
        }
        
        if (!$ipAddress) {
            $ipKeys = ['client_ip', 'ip', '_ip', 'REMOTE_ADDR', 'user_ip'];
            foreach ($ipKeys as $key) {
                if (isset($data[$key]) && !empty($data[$key])) {
                    $ipAddress = $data[$key];
                    break;
                }
            }
        }

        $uaKeys = ['user_agent', '_user_agent', 'HTTP_USER_AGENT', 'userAgent'];
        foreach ($uaKeys as $key) {
            if (isset($data[$key]) && !empty($data[$key])) {
                $userAgent = $data[$key];
                break;
            }
        }

        if (!$userAgent && isset($data['_previous']['request'])) {
            $request = $data['_previous']['request'];
            $userAgent = $request['HTTP_USER_AGENT'] ?? $request['user_agent'] ?? null;
        }

        $loginKey = 'login_web_' . sha1('App\\Models\\User');
        if (isset($data[$loginKey]) && is_numeric($data[$loginKey])) {
            $userId = (int)$data[$loginKey];
        }

        if (!$userId) {
            foreach ($data as $key => $value) {
                if (str_starts_with($key, 'login_web_') && is_numeric($value)) {
                    $userId = (int)$value;
                    break;
                }
            }
        }

        if (!$userId) return null;


        return [
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'current_page' => $currentPage,
        ];
    }

    private function extractUserDataViaRegex($content)
    {
        if (preg_match('/"login_web_[a-f0-9]{32}"[^\d]*?(\d+)/', $content, $matches)) {
            $userId = (int)$matches[1];
        } else {
            if (preg_match('/"user_id"[^0-9]*?(\d+)/', $content, $matches)) {
                $userId = (int)$matches[1];
            } else {
                return null;
            }
        }

        $ip = null;
        $ipPatterns = [
            '/"ip"[^"]*?"([^"]+)"/',
            '/"client_ip"[^"]*?"([^"]+)"/',
            '/"_ip"[^"]*?"([^"]+)"/',
            '/s:2:"ip";s:\d+:"([^"]+)"/',
            '/"REMOTE_ADDR"[^"]*?"([^"]+)"/',
            '/REMOTE_ADDR["\']?\s*[=:]\s*["\']?([0-9.]+)/',
        ];
        
        foreach ($ipPatterns as $pattern) {
            if (preg_match($pattern, $content, $ipMatch)) {
                $ip = $ipMatch[1];
                break;
            }
        }

  
        $ua = null;
        $uaPatterns = [
            '/"user_agent"[^"]*?"([^"]+)"/',
            '/"_user_agent"[^"]*?"([^"]+)"/',
            '/"HTTP_USER_AGENT"[^"]*?"([^"]+)"/',
            '/s:10:"user_agent";s:\d+:"([^"]+)"/',
            '/HTTP_USER_AGENT["\']?\s*[=:]\s*["\']?([^"\']+)/',
        ];
        
        foreach ($uaPatterns as $pattern) {
            if (preg_match($pattern, $content, $uaMatch)) {
                $ua = $uaMatch[1];
                break;
            }
        }

        $currentPage = null;
        if (preg_match('/"_previous"[^}]*"url"[^"]*"([^"]+)"/', $content, $urlMatch)) {
            $currentPage = $this->extractPageFromUrl($urlMatch[1]);
        }

        return [
            'user_id' => $userId,
            'ip_address' => $ip,
            'user_agent' => $ua,
            'current_page' => $currentPage,
        ];
    }

    private function deleteSession($sessionId, $userId = null)
    {
        $driver = $this->getSessionDriver();

        if ($driver === 'database') {
            return DB::table('sessions')->where('id', $sessionId)->delete();
        } elseif ($driver === 'file') {
            $sessionPath = config('session.files') . '/' . $sessionId;
            if (File::exists($sessionPath)) {
                return File::delete($sessionPath);
            }
        }

        return false;
    }

    private function deleteUserSessions($userId)
    {
        $driver = $this->getSessionDriver();

        if ($driver === 'database') {
            return DB::table('sessions')->where('user_id', $userId)->delete();
        } elseif ($driver === 'file') {
            $deleted = 0;
            $sessions = $this->getFileSessions();

            foreach ($sessions as $session) {
                if ($session->user_id == $userId) {
                    if ($this->deleteSession($session->id, $userId)) {
                        $deleted++;
                    }
                }
            }

            return $deleted;
        }

        return 0;
    }

    private function forceInvalidateUser($userId)
    {
        DB::beginTransaction();
        try {
            Cache::put('force_logged_out:' . $userId, true, now()->addMinutes(1));
              $this->deleteUserSessions($userId);

            User::where('id', $userId)->increment('login_token');

            User::where('id', $userId)->update(['remember_token' => null]);

            $user = User::find($userId);
            if ($user && method_exists($user, 'tokens')) {
                $user->tokens()->delete();
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function index()
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('app_settings.session_management');
    }
    private function getDeviceFromUserAgent($userAgent)
    {
        if (empty($userAgent)) return 'Unknown';

        $device = 'Unknown';

        if (preg_match('/Mobile|Android|iP(hone|od|ad)/i', $userAgent)) {
            $device = 'Mobile';
        } elseif (preg_match('/Tablet|iPad/i', $userAgent)) {
            $device = 'Tablet';
        } elseif (preg_match('/Linux|Windows|Mac OS|X/i', $userAgent)) {
            $device = 'Desktop';
        }

        return $device;
    }

    private function getBrowserFromUserAgent($userAgent)
    {
        if (empty($userAgent)) return 'Unknown';

        if (preg_match('/Chrome/i', $userAgent) && !preg_match('/Edg/i', $userAgent)) {
            return 'Chrome';
        } elseif (preg_match('/Edg/i', $userAgent)) {
            return 'Edge';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            return 'Firefox';
        } elseif (preg_match('/Safari/i', $userAgent) && !preg_match('/Chrome/i', $userAgent)) {
            return 'Safari';
        } elseif (preg_match('/Opera|OPR/i', $userAgent)) {
            return 'Opera';
        } elseif (preg_match('/MSIE|Trident/i', $userAgent)) {
            return 'Internet Explorer';
        }

        return 'Unknown';
    }

    public function getData(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        $filter = $request->get('filter', 'all');

        if (in_array($filter, ['active_businesses', 'inactive_businesses'])) {
            return $this->getBusinessData($request);
        }

        $activeSessions = $this->getActiveSessions();
        $activeUserIds = $activeSessions->pluck('user_id')->unique()->toArray();

        $query = User::with(['business'])
            ->select('users.*');

        if ($filter === 'all') {
            $query->whereIn('users.id', $activeUserIds);
        }

        if ($filter === 'active') {
            $query->where('users.status', 'active')
                ->where('users.allow_login', 1)
                ->whereNull('users.locked_until');
        } elseif ($filter === 'locked') {
            $query->whereNotNull('users.locked_until')
                ->where('users.locked_until', '>', now());
        } elseif ($filter === 'disabled') {
            $query->where(function ($q) {
                $q->where('users.status', 'inactive')
                    ->orWhere('users.allow_login', 0);
            });
        } elseif ($filter === 'active_businesses') {
            $query->whereHas('business', function ($q) {
                $q->where('is_active', 1);
            });
        } elseif ($filter === 'inactive_businesses') {
            $query->whereHas('business', function ($q) {
                $q->where('is_active', 0);
            });
        }

        $users = $query->get();

        $usersWithSessions = $users->map(function ($user) use ($activeSessions) {
            $userSessions = $activeSessions->where('user_id', $user->id)->sortByDesc('last_activity');
            $latestSession = $userSessions->first();

            $user->all_sessions = $userSessions->values()->all();
            $user->session_id = $latestSession ? $latestSession->id : null;
            $user->ip_address = $latestSession ? $latestSession->ip_address : null;
            $user->user_agent = $latestSession ? $latestSession->user_agent : null;
            $user->current_page = $latestSession ? $latestSession->current_page : null;
            $user->last_activity = $latestSession ? $latestSession->last_activity : null;
            $user->session_count = $userSessions->count();

            return $user;
        });

        return DataTables::of($usersWithSessions)
            ->addColumn('user_info', function ($row) {
                $html = '<div class="user-details">';
                $html .= '<strong>' . $row->first_name . ' ' . $row->last_name . '</strong><br>';
                $html .= '<small class="text-muted">@' . $row->username . '</small><br>';
                $html .= '<small class="text-primary">' . $row->email . '</small>';
                $html .= '</div>';
                return $html;
            })
          
            ->addColumn('business_info', function ($row) {
                $business = $row->business;
                if (!$business) return '<span class="text-muted">N/A</span>';

                $status_class = $business->is_active ? 'badge-success' : 'badge-danger';
                $status_text = $business->is_active ? __('settings.active') : __('settings.inactive');

                $html = '<div class="business-info">';
                $html .= '<strong>' . $business->name . '</strong><br>';
                $html .= '<span class="badge ' . $status_class . '">' . $status_text . '</span>';
                $html .= '</div>';
                return $html;
            })
           
            ->addColumn('session_info', function ($row) {
                if (!$row->last_activity || empty($row->all_sessions)) {
                    return '<span class="text-muted">No active session</span>';
                }

                $timezone = session('business.time_zone', config('app.timezone'));
                $uniqueId = 'sessions-' . $row->id;
                
                if (is_numeric($row->last_activity)) {
                    $last_activity = Carbon::createFromTimestamp($row->last_activity);
                } else {
                    $last_activity = Carbon::parse($row->last_activity);
                }
                $last_activity->setTimezone($timezone);

                $device = $this->getDeviceFromUserAgent($row->user_agent ?? '');
                $browser = $this->getBrowserFromUserAgent($row->user_agent ?? '');

                $html = '<div class="session-info">';
                $html .= '<strong>' . $last_activity->format('Y-m-d H:i:s') . '</strong><br>';
                $html .= '<small class="text-muted">';
                $html .= ($row->ip_address ?? 'Unknown IP') . ' • ' . ($device ?: 'Unknown') . ' • ' . ($browser ?: 'Unknown');
                $html .= '</small><br>';
                
                if ($row->current_page) {
                    if (is_array($row->current_page)) {
                        $html .= '<small class="text-primary"><i class="fas fa-file-alt"></i> <a href="' . $row->current_page['url'] . '" target="_blank" style="color: inherit; text-decoration: underline;">' . $row->current_page['name'] . '</a></small><br>';
                    } else {
                        $html .= '<small class="text-primary"><i class="fas fa-file-alt"></i> ' . $row->current_page . '</small><br>';
                    }
                }

                if ($row->session_count > 1) {
                    $html .= '<span class="badge badge-info session-toggle" style="cursor: pointer;" onclick="toggleSessionDetails(\'' . $uniqueId . '\')" title="Click to show all sessions">';
                    $html .= '<i class="fas fa-expand-alt"></i> ' . $row->session_count . ' sessions';
                    $html .= '</span>';
                    
                    $html .= '<div id="' . $uniqueId . '" style="display: none; margin-top: 10px; padding-top: 10px; border-top: 1px solid #eee;">';
                    $html .= '<strong>All Sessions:</strong><br>';
                    
                    $sessionNumber = 1;
                    foreach ($row->all_sessions as $session) {
                        if (is_numeric($session->last_activity)) {
                            $activity = Carbon::createFromTimestamp($session->last_activity);
                        } else {
                            $activity = Carbon::parse($session->last_activity);
                        }
                        $activity->setTimezone($timezone);
                        
                        $sessionDevice = $this->getDeviceFromUserAgent($session->user_agent ?? '');
                        $sessionBrowser = $this->getBrowserFromUserAgent($session->user_agent ?? '');
                        
                        $html .= '<small class="text-muted" style="display: block; margin-bottom: 5px;">';
                        $html .= '<strong>' . $sessionNumber . '.</strong> ';
                        $html .= ($session->ip_address ?? 'Unknown IP') . ' • ';
                        $html .= ($sessionDevice ?: 'Unknown') . ' • ';
                        $html .= ($sessionBrowser ?: 'Unknown');
                        
                        if ($session->current_page) {
                            if (is_array($session->current_page)) {
                                $html .= ' • <a href="' . $session->current_page['url'] . '" target="_blank" style="color: var(--primary-color, #007bff); text-decoration: underline;">' . $session->current_page['name'] . '</a>';
                            } else {
                                $html .= ' • <span class="text-primary">' . $session->current_page . '</span>';
                            }
                        }
                        
                        $html .= '<br><em>' . $activity->format('M j, H:i') . '</em>';
                        $html .= '</small>';
                        
                        $sessionNumber++;
                    }
                    $html .= '</div>';
                } else {
                    $html .= '<span class="badge badge-info">' . $row->session_count . ' session</span>';
                }
                
                $html .= '</div>';

                return $html;
            })
            ->addColumn('user_status', function ($row) {
                $html = '<div class="status-info">';

                $status_class = $row->status === 'active' ? 'badge-success' : 'badge-danger';
                $html .= '<span class="badge ' . $status_class . '">' . ucfirst($row->status) . '</span><br>';

                $login_class = $row->allow_login ? 'badge-success' : 'badge-danger';
                $login_text = $row->allow_login ? __('settings.login_allowed') : __('settings.login_blocked');
                $html .= '<span class="badge ' . $login_class . '">' . $login_text . '</span><br>';

                if ($row->locked_until && $row->locked_until > now()) {
                    $locked_until = Carbon::parse($row->locked_until)->setTimezone(session('business.time_zone', config('app.timezone')));
                    $html .= '<span class="badge badge-warning">Locked</span><br>';
                    $html .= '<small class="text-danger">Until: ' . $locked_until->format('Y-m-d H:i A') . '</small>';
                }

                $html .= '</div>';
                return $html;
            })
            ->addColumn('actions', function ($row) use ($filter) {
                $html = '<div class="btn-group">
                <button type="button" class="dropdown-toggle btn-xs" 
                    data-toggle="dropdown" aria-expanded="false">
                    <img src="' . asset('img/icons/item.svg') . '" alt="">
                </button>
                <ul class="dropdown-menu dropdown-menu-left" role="menu">';

                if ($filter === 'locked') {
                    if ($row->locked_until && $row->locked_until > now()) {
                        $html .= '<li><a href="javascript:void(0)" onclick="unlock_user(' . $row->id . ', \'' . e($row->username) . '\')">
                          <i class="fas fa-unlock"></i> ' . __('settings.unlock_user') . '
                      </a></li>';
                    }
                } elseif ($filter === 'disabled') {
                    if (!$row->allow_login) {
                        $html .= '<li><a href="javascript:void(0)" onclick="toggle_login_permission(' . $row->id . ', 1, \'' . e($row->username) . '\')">
                          <i class="fas fa-check-circle"></i> ' . __('settings.allow_login') . '
                      </a></li>';
                    }
                    if ($row->status === 'inactive') {
                        $html .= '<li><a href="javascript:void(0)" onclick="toggle_user_status(' . $row->id . ', \'active\', \'' . e($row->username) . '\')">
                          <i class="fas fa-user-check"></i> ' . __('settings.activate_user') . '
                      </a></li>';
                    }
                } else {
                    if ($row->session_id) {
                        $html .= '<li><a href="javascript:void(0)" onclick="force_logout(\'' . $row->session_id . '\', \'' . e($row->username) . '\')">
                          <i class="fas fa-sign-out-alt"></i> ' . __('settings.force_logout') . '
                      </a></li>';
                    }

                    if (!$row->locked_until || $row->locked_until <= now()) {
                        $html .= '<li><a href="javascript:void(0)" onclick="show_lock_modal(' . $row->id . ', \'' . e($row->username) . '\')">
                          <i class="fas fa-lock"></i> ' . __('settings.lock_user') . '
                      </a></li>';
                    } else {
                        $html .= '<li><a href="javascript:void(0)" onclick="unlock_user(' . $row->id . ', \'' . e($row->username) . '\')">
                          <i class="fas fa-unlock"></i> ' . __('settings.unlock_user') . '
                      </a></li>';
                    }

                    $html .= '<li class="divider"></li>';

                    if ($row->status === 'active') {
                        $html .= '<li><a href="javascript:void(0)" onclick="toggle_user_status(' . $row->id . ', \'inactive\', \'' . e($row->username) . '\')">
                          <i class="fas fa-user-times"></i> ' . __('settings.deactivate_user') . '
                      </a></li>';
                    } else {
                        $html .= '<li><a href="javascript:void(0)" onclick="toggle_user_status(' . $row->id . ', \'active\', \'' . e($row->username) . '\')">
                          <i class="fas fa-user-check"></i> ' . __('settings.activate_user') . '
                      </a></li>';
                    }

                    if ($row->allow_login) {
                        $html .= '<li><a href="javascript:void(0)" onclick="toggle_login_permission(' . $row->id . ', 0, \'' . e($row->username) . '\')">
                          <i class="fas fa-ban"></i> ' . __('settings.block_login') . '
                      </a></li>';
                    } else {
                        $html .= '<li><a href="javascript:void(0)" onclick="toggle_login_permission(' . $row->id . ', 1, \'' . e($row->username) . '\')">
                          <i class="fas fa-check-circle"></i> ' . __('settings.allow_login') . '
                      </a></li>';
                    }

                    if ($row->business) {
                        $html .= '<li class="divider"></li>';
                        if ($row->business->is_active) {
                            $html .= '<li><a href="javascript:void(0)" onclick="toggle_business_status(' . $row->business->id . ', 0, \'' . e($row->business->name) . '\')">
                              <i class="fas fa-building"></i> ' . __('settings.deactivate_business') . '
                          </a></li>';
                        } else {
                            $html .= '<li><a href="javascript:void(0)" onclick="toggle_business_status(' . $row->business->id . ', 1, \'' . e($row->business->name) . '\')">
                              <i class="fas fa-building"></i> ' . __('settings.activate_business') . '
                          </a></li>';
                        }
                    }
                }

                $html .= '</ul></div>';
                return $html;
            })
            ->rawColumns(['user_info', 'business_info', 'session_info', 'user_status', 'actions'])
            ->make(true);
    }

    private function getBusinessData(Request $request)
    {
        $filter = $request->get('filter');

        $query = Business::select('business.*');

        if ($filter === 'active_businesses') {
            $query->where('is_active', 1);
        } elseif ($filter === 'inactive_businesses') {
            $query->where('is_active', 0);
        }

        $businesses = $query->get();

        return DataTables::of($businesses)
            ->addColumn('user_info', function ($row) {
                $userCount = User::where('business_id', $row->id)->count();
                $activeUserCount = User::where('business_id', $row->id)
                    ->where('status', 'active')
                    ->where('allow_login', 1)
                    ->count();

                $html = '<div class="user-details">';
                $html .= '<strong>' . $row->name . '</strong><br>';
                $html .= '<small class="text-muted">' . $userCount . ' total users</small><br>';
                $html .= '<small class="text-primary">' . $activeUserCount . ' active users</small>';
                $html .= '</div>';
                return $html;
            })
            ->addColumn('business_info', function ($row) {
                $status_class = $row->is_active ? 'badge-success' : 'badge-danger';
                $status_text = $row->is_active ? __('settings.active') : __('settings.inactive');

                $html = '<div class="business-info">';
                $html .= '<strong>' . $row->name . '</strong><br>';
                $html .= '<span class="badge ' . $status_class . '">' . $status_text . '</span>';
                $html .= '</div>';
                return $html;
            })
            ->addColumn('session_info', function ($row) {
                $created_at = Carbon::parse($row->created_at);
                $timezone = session('business.time_zone', config('app.timezone'));
                $created_at->setTimezone($timezone);

                $html = '<div class="session-info">';
                $html .= '<strong>Created: ' . $created_at->format('Y-m-d H:i:s') . '</strong><br>';
                $html .= '<small class="text-muted">Business ID: ' . $row->id . '</small>';
                $html .= '</div>';
                return $html;
            })
            ->addColumn('user_status', function ($row) {
                $status_class = $row->is_active ? 'badge-success' : 'badge-danger';
                $status_text = $row->is_active ? __('settings.active') : __('settings.inactive');

                return '<span class="badge ' . $status_class . '">' . $status_text . '</span>';
            })
            ->addColumn('actions', function ($row) {
                $html = '<div class="btn-group">
                            <button type="button" class="dropdown-toggle btn-xs" 
                                data-toggle="dropdown" aria-expanded="false">
                                <img src="' . asset('img/icons/item.svg') . '" alt="">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">';

                if ($row->is_active) {
                    $html .= '<li><a href="javascript:void(0)" onclick="toggle_business_status(' . $row->id . ', 0, \'' . e($row->name) . '\')">
                                  <i class="fas fa-building"></i> ' . __('settings.deactivate_business') . '
                              </a></li>';
                } else {
                    $html .= '<li><a href="javascript:void(0)" onclick="toggle_business_status(' . $row->id . ', 1, \'' . e($row->name) . '\')">
                                  <i class="fas fa-building"></i> ' . __('settings.activate_business') . '
                              </a></li>';
                }

                $html .= '</ul></div>';
                return $html;
            })
            ->rawColumns(['user_info', 'business_info', 'session_info', 'user_status', 'actions'])
            ->make(true);
    }

    public function forceLogout(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        $request->validate(['session_id' => 'required|string']);
        $sessionId = $request->session_id;

        try {
            $userId = null;
            $driver = $this->getSessionDriver();

            if ($driver === 'file') {
                $sessionPath = config('session.files') . '/' . $sessionId;
                if (File::exists($sessionPath)) {
                    $content = File::get($sessionPath);
                    $sessionData = $this->parseFileSession($content);
                    $userId = $sessionData['user_id'] ?? null;
                }
            } elseif ($driver === 'database') {
                $session = DB::table('sessions')->where('id', $sessionId)->first();
                $userId = $session?->user_id;
            }

            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session not found or invalid'
                ]);
            }

            if (!$this->forceInvalidateUser($userId)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to completely invalidate user session'
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => __('settings.user_logged_out_successfully')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('settings.failed_to_logout_user')
            ]);
        }
    }
    private function sessionExists($sessionId)
    {
        $driver = $this->getSessionDriver();
        if ($driver === 'file') {
            return File::exists(config('session.files') . '/' . $sessionId);
        }
        return DB::table('sessions')->where('id', $sessionId)->exists();
    }
    public function lockUser(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'duration' => 'required|integer|min:1|max:1440'
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            $user->locked_until = now()->addMinutes((int) $request->duration);
            $user->save();

            $this->forceInvalidateUser($user->id);
            return response()->json([
                'success' => true,
                'message' => __('settings.user_locked_successfully', ['duration' => $request->duration])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('settings.failed_to_lock_user')
            ]);
        }
    }

    public function unlockUser(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            $user->locked_until = null;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => __('settings.user_unlocked_successfully')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('settings.failed_to_unlock_user')
            ]);
        }
    }

    public function toggleUserStatus(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            $user->status = $request->status;
            $user->save();


            if ($request->status === 'inactive') {
                $this->forceInvalidateUser($user->id);
            }

            $message = $request->status === 'active' ?
                __('settings.user_activated_successfully') :
                __('settings.user_deactivated_successfully');

            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('settings.failed_to_update_user_status')
            ]);
        }
    }

    public function toggleLoginPermission(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'allow_login' => 'required|boolean'
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            $user->allow_login = $request->allow_login;
            $user->save();

            if (!$request->allow_login) {
                $this->forceInvalidateUser($user->id);
            }

            $message = $request->allow_login ?
                __('settings.login_permission_granted') :
                __('settings.login_permission_revoked');

            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('settings.failed_to_update_login_permission')
            ]);
        }
    }

    public function toggleBusinessStatus(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        $request->validate([
            'business_id' => 'required|exists:business,id',
            'is_active' => 'required|boolean'
        ]);

        try {
            $business = Business::findOrFail($request->business_id);
            $business->is_active = $request->is_active;
            $business->save();

            if (!$request->is_active) {
                $business_users = User::where('business_id', $business->id)->pluck('id');
                foreach ($business_users as $userId) {
                    $this->forceInvalidateUser($userId);
                }
            }

            $message = $request->is_active ?
                __('settings.business_activated_successfully') :
                __('settings.business_deactivated_successfully');

            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('settings.failed_to_update_business_status')
            ]);
        }
    }

    public function getStats()
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        $stats = [
            'active_sessions' => DB::table('sessions')
                ->whereNotNull('user_id')
                ->count(),

            'unique_users' => DB::table('sessions')
                ->whereNotNull('user_id')
                ->distinct('user_id')
                ->count(),

            'locked_users' => User::whereNotNull('locked_until')
                ->where('locked_until', '>', now())
                ->count(),

            'disabled_users' => User::where(function ($q) {
                $q->where('status', 'inactive')
                    ->orWhere('allow_login', 0);
            })->count(),

            'active_businesses' => Business::where('is_active', 1)->count(),

            'inactive_businesses' => Business::where('is_active', 0)->count()
        ];

        return response()->json($stats);
    }
}
