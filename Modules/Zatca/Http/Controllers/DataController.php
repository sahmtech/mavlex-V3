<?php

namespace Modules\Zatca\Http\Controllers;
use Illuminate\Routing\Controller;


class DataController extends Controller
{


    /**
     * Superadmin package permissions
     *
     * @return array
     */
    public function superadmin_package()
    {
        return [
            [
                'name' => 'zatca_module',
                'label' => __('zatca::lang.zatca_module'),
                'default' => false,
            ],
        ];
    }


    /**
     * Defines user permissions for the module.
     *
     * @return array
     */
    public function user_permissions()
    {
        $permissions = [
            [
                'value' => 'zatca.settings',
                'label' => __('zatca::lang.compliance_settings'),
                'default' => false,
            ],
            [
                'value' => 'zatca.tax_report',
                'label' => __('zatca::lang.zatca_tax_report'),
                'default' => false,
            ],
            [
                'value' => 'zatca.sync_report',
                'label' => __('zatca::lang.sync_report'),
                'default' => false,
        ],
            ];

        return $permissions;
    }

    // public function contact_form_part($data)
    // {
    //     if ($data['view'] == 'contact.create') {
    //         $contact = ! empty($data['contact']) ? $data['contact'] : null;
    //         $street_name = $contact->street_name;
    //         $building_number = $contact->building_number;
    //         $plot_identification = $contact->plot_identification;
    //         $city_subdivision_name = $contact->city_subdivision_name;
    //         $city = $contact->city;
    //         $country = $contact->country;
    //         $postal_number = $contact->zip_code;
    //         $tax_number = $contact->tax_number;
    //         $registration_name = $contact->registration_name;
    
    //         return view('zatca::partials.contact_details_part', compact(
    //             'contact',
    //             'street_name',
    //             'building_number',
    //             'plot_identification',
    //             'city_subdivision_name',
    //             'city',
    //             'country',
    //             'postal_number',
    //             'tax_number',
    //             'registration_name'
    //         ))->render();
    //     }
    // }
    

}