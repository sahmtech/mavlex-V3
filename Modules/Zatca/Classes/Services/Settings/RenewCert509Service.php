<?php

namespace Modules\Zatca\Classes\Services\Settings;

use Modules\Zatca\Classes\Actions\PostRequestAction;

class RenewCert509Service extends Cert509Service
{    
    /**
     * renew the cert 509
     *
     * @param  string $otp
     * @param  object $settings
     * @return object
     */
    public function renew(string $otp, object $settings): object
    {
        $response = (new PostRequestAction)->handle(
            '/production/csids', 
            ['csr' => $settings->csr], 
            $this->getHeaders($otp), 
            $settings->cert_production . ":" . $settings->secret_production, 
            'PATCH'
        );

        $settings->cert_production = $response['binarySecurityToken'];
        $settings->secret_production = $response['secret'];
        $settings->csid_id_production = $response['requestID'];

        return $settings;
    }
}
