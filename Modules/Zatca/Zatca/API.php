<?php

namespace App\ZATCA;

use stdClass;
use Exception;
use GuzzleHttp\Client;

class API
{
    private string $sandbox_url = 'https://gw-fatoora.zatca.gov.sa/e-invoicing/developer-portal';
    private string $version = 'V2';

    private function getAuthHeaders($certificate, $secret): array
    {
        if ($certificate && $secret) {

            $certificate_stripped = $this->cleanUpCertificateString($certificate);
            $certificate_stripped = base64_encode($certificate_stripped);
            $basic = base64_encode($certificate_stripped . ':' . $secret);

            return [
                "Authorization: Basic $basic",
            ];
        }
        return [];
    }

    public function compliance($certificate = NULL, $secret = NULL)
    {
        $auth_headers = $this->getAuthHeaders($certificate, $secret);

        $issueCertificate = function (string $csr, string $otp): stdClass {
            $headers = [
                'Accept-Version: ' . $this->version,
                'OTP: ' . $otp,
                'Content-Type: application/json'
            ];

            $curl = curl_init($this->sandbox_url . '/compliance');

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode(['csr' => "LS0tLS1CRUdJTiBDRVJUSUZJQ0FURSBSRVFVRVNULS0tLS0KTUlJQ0ZUQ0NBYndDQVFBd2RURUxNQWtHQTFVRUJoTUNVMEV4RmpBVUJnTlZCQXNNRFZKcGVXRmthQ0JDY21GdQpZMmd4SmpBa0JnTlZCQW9NSFUxaGVHbHRkVzBnVTNCbFpXUWdWR1ZqYUNCVGRYQndiSGtnVEZSRU1TWXdKQVlEClZRUUREQjFVVTFRdE9EZzJORE14TVRRMUxUTTVPVGs1T1RrNU9Ua3dNREF3TXpCV01CQUdCeXFHU000OUFnRUcKQlN1QkJBQUtBMElBQktGZ2ltdEVtdlJTQkswenI5TGdKQXRWU0NsOFZQWno2Y2RyNVgrTW9USG84dkhOTmx5Vwo1UTZ1N1Q4bmFQSnF0R29UakpqYVBJTUo0dTE3ZFNrL1ZIaWdnZWN3Z2VRR0NTcUdTSWIzRFFFSkRqR0IxakNCCjB6QWhCZ2tyQmdFRUFZSTNGQUlFRkF3U1drRlVRMEV0UTI5a1pTMVRhV2R1YVc1bk1JR3RCZ05WSFJFRWdhVXcKZ2FLa2daOHdnWnd4T3pBNUJnTlZCQVFNTWpFdFZGTlVmREl0VkZOVWZETXRaV1F5TW1ZeFpEZ3RaVFpoTWkweApNVEU0TFRsaU5UZ3RaRGxoT0dZeE1XVTBORFZtTVI4d0hRWUtDWkltaVpQeUxHUUJBUXdQTXprNU9UazVPVGs1Ck9UQXdNREF6TVEwd0N3WURWUVFNREFReE1UQXdNUkV3RHdZRFZRUWFEQWhTVWxKRU1qa3lPVEVhTUJnR0ExVUUKRHd3UlUzVndjR3g1SUdGamRHbDJhWFJwWlhNd0NnWUlLb1pJemowRUF3SURSd0F3UkFJZ1NHVDBxQkJ6TFJHOApJS09melI1L085S0VicHA4bWc3V2VqUlllZkNZN3VRQ0lGWjB0U216MzAybmYvdGo0V2FxbVYwN01qZVVkVnVvClJJckpLYkxtUWZTNwotLS0tLUVORCBDRVJUSUZJQ0FURSBSRVFVRVNULS0tLS0K"]),
                CURLOPT_HTTPHEADER => $headers,
            ));

            $response = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $response = json_decode($response);

            if ($http_code != 200) throw new Exception('Error issuing a compliance certificate.');

            $issued_certificate = base64_decode($response->binarySecurityToken);
            $response->binarySecurityToken = "-----BEGIN CERTIFICATE-----\n{$issued_certificate}\n-----END CERTIFICATE-----";

            return $response;
        };

        $checkInvoiceCompliance = function (string $signed_invoice_string, string $invoice_hash, string $uuid) use ($auth_headers): stdClass {

            $headers = [
                'Accept-Version: ' . $this->version,
                'Accept-Language: en',
                'Content-Type: application/json',
            ];

            $curl = curl_init($this->sandbox_url . '/compliance/invoices');

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode([
                    'invoiceHash' => $invoice_hash,
                    'uuid' => $uuid,
                    'invoice' => base64_encode($signed_invoice_string),
                ]),
                CURLOPT_HTTPHEADER => [...$headers, ...$auth_headers],
            ));

            $response = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $response = json_decode($response);
            dd($response);
            print_r($response);
            if ($http_code != 200) throw new Exception('Error in compliance check.');
            return $response;
        };

        return [$issueCertificate, $checkInvoiceCompliance];
    }

    public static function cleanUpCertificateString(string $certificate): string
    {
        $certificate = str_replace('-----BEGIN CERTIFICATE-----', '', $certificate);
        $certificate = str_replace('-----END CERTIFICATE-----', '', $certificate);

        return trim($certificate);
    }
}