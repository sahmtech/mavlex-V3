<?php

namespace Modules\Zatca\Helpers;

use Exception;
use App\Models\Transaction;
use App\Models\Business;
use Illuminate\Support\Facades\Log;
use Modules\Zatca\Entities\ZatcaSetting;

class ConfigHelper
{
    /**
     * Get the environment value.
     *
     * @return string
     */

     public static function environment(): string
{
    $transaction_id = CurrentTransaction::getTransactionId();
    if (! $transaction_id) {
        $routeTxn = request()->route('transactionId')  ?: request()->route('transaction_id') ?: request()->route('transaction');
         $transaction_id = $routeTxn;
    }

    if ($transaction_id) {
        $transaction = Transaction::with('location.zatcaSetting','business.settings')->find($transaction_id);
        $env = $transaction->location?->zatcaSetting?->zatca_env;
       
        if ($env) {
            return $env;
        }
    }
     $locationId = request()->route('location') ?: request('location_id');
     if ($locationId) {
        $zs  = ZatcaSetting::where('location_id', $locationId)->first();
        $env = $zs?->zatca_env;
       
        if ($env) {
            return $env;
        }
    }
    $env = config('zatca.env', 'production');
    return $env;
}

    /**
     * Determine if environment is production or local for testing.
     *
     * @return bool
     */
    public static function isProduction(): bool
    {
        return self::environment() === 'production';
    }

    /**
     * Determine if environment has the six complaints check.
     *
     * @return bool
     */
    public static function hasComplaintsCheck(): bool
    {
        return in_array(self::environment(), ['production', 'simulation']) ?? false;
    }

    /**
     * Get template name for the cert509.
     *
     * @return string
     */
    public static function certificateTemplateName(): string
    {
        switch (self::environment()) {
            case 'production':
                return 'ZATCA-Code-Signing';

            case 'simulation':
                return 'PREZATCA-Code-Signing';

            default:
                return 'TSTZATCA-Code-Signing';
        }
    }

    /**
     * Get the portal based on environment.
     *
     * @return string
     * @throws Exception
     */
    public static function portal(): string
    {
        $env = self::environment();
        $portal = self::get("zatca.portals." . $env);

        if (!$portal) {
            throw new Exception("Portal configuration not found for environment: {$env}!");
        }

        return $portal;
    }

    /**
     * Get key from config file.
     *
     * @param string $key
     * @return mixed|null
     */
    public static function get(string $key)
    {
        if (function_exists('config')) {
            return config($key);
        } else {
            $constant = constant(strtoupper(str_replace('.', '_', $key)));

            if (is_null($constant)) {
                throw new Exception("Unhandled config identifier: {$key}!");
            }

            return $constant;
        }
    }
}
