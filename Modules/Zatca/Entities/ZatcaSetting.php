<?php

namespace Modules\Zatca\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Business;

class ZatcaSetting extends Model
{
    use HasFactory;
    protected $table = 'zatca_settings';

    protected $fillable = [
        'tax_number_1','tax_label_1','tax_number_2','tax_label_2',
        'business_id',
        'location_id',
        'zatca_env',
        'city',
        'country',
        'postal_number',
        'invoice_issue_type',
        'company_address',
        'businessCategory',
        'is_phase_two',
        'otp',
        'invoicing_type',
        'private_key',
        'public_key',
        'csr_request',
        'cnf',
        'cert_compliance',
        'secret_compliance',
        'csid_id_compliance',
        'cert_production',
        'secret_production',
        'csid_id_production',
        'is_connected',
        'street_name',
        'building_number',
        'plot_identification',
        'city_sub_division',
        'enable_auto_sync',
        'sync_frequency',
    ];

    
    /**
     * Get the business that owns the ZATCA settings.
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
    public function location()
    {
        return $this->belongsTo(\App\Models\BusinessLocation::class,'location_id',  'id');
    }
}
