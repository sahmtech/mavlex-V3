<?php

namespace Modules\Zatca\Classes\Actions;

use Modules\Zatca\Helpers\ConfigHelper;
use Exception;

class PostRequestAction
{
    /**
     * handle sending the request to zatca portal.
     *
     * @param  string   $route
     * @param  array    $data
     * @param  array    $headers
     * @param  string   $USERPWD
     * @param  string   $method
     * @return array
     */
    public function handle(string $route, array $data, array $headers, string $USERPWD, string $method = 'POST'): array
    {
        $portal = ConfigHelper::portal();
        $zatca_env = env('ZATCA_ENV', 'production');
        $ch = curl_init($portal . $route);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (!empty($USERPWD)) {
            curl_setopt($ch, CURLOPT_USERPWD, $USERPWD);
        }

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Disable SSL verification if ZATCA_ENV is set to "local"
        if ($zatca_env === 'localhost') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $response = json_decode($response, true);

        curl_close($ch);

        return (new HandleResponseAction)->handle($httpcode, $response);
    }
}
