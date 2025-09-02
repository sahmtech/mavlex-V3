<?php

namespace Modules\Zatca\Classes\Services\Settings;

use Modules\Zatca\Classes\Actions\PostRequestAction;
use Modules\Zatca\Classes\InvoiceReportType;
use Modules\Zatca\Helpers\ConfigHelper;
use Modules\Zatca\Classes\Services\Compliants\SimplifiedCompliantService;
use Modules\Zatca\Classes\Services\Compliants\SimplifiedCreditNoteCompliantService;
use Modules\Zatca\Classes\Services\Compliants\SimplifiedDebitNoteCompliantService;
use Modules\Zatca\Classes\Services\Compliants\StandardCompliantService;
use Modules\Zatca\Classes\Services\Compliants\StandardCreditNoteCompliantService;
use Modules\Zatca\Classes\Services\Compliants\StandardDebitNoteCompliantService;

class Cert509Service
{
    /**
     * the data of a tax payer.
     *
     * @var \Modules\Zatca\Classes\Objects\Setting
     */
    protected $seller;

    /**
     * __construct
     *
     * @param  object|null $seller
     * @return void
     */
    public function __construct(object $seller = null)
    {
        $this->seller = $seller;
    }


    /**
     * generate the certificate 509 & other data.
     *
     * @param  object $settings
     * @return void
     */
    public function generate(object &$settings): void
    {

        $this->handleComplianceMode($settings);

        $privateKey     = $settings->private_key;
        $certificate    = $settings->cert_compliance;
        $secret         = $settings->secret_compliance;

        // Send the 6 test invoices for the production certificate...
        if(ConfigHelper::hasComplaintsCheck()) {
            if(InvoiceReportType::isStandard($this->seller->invoiceType)) {
                StandardCompliantService::verify($this->seller, $privateKey, $certificate, $secret);
                StandardCreditNoteCompliantService::verify($this->seller, $privateKey, $certificate, $secret);
                StandardDebitNoteCompliantService::verify($this->seller, $privateKey, $certificate, $secret);
            }

            if(InvoiceReportType::isSimplified($this->seller->invoiceType)) {
                SimplifiedCompliantService::verify($this->seller, $privateKey, $certificate, $secret);
                SimplifiedCreditNoteCompliantService::verify($this->seller, $privateKey, $certificate, $secret);
                SimplifiedDebitNoteCompliantService::verify($this->seller, $privateKey, $certificate, $secret);
            }
        }

        $this->handleProductionMode($settings);

    }

    /**
     * when production mode.
     *
     * @param  object $settings
     * @return void
     */
    public function handleProductionMode(object &$settings): void
    {
        $this->setCert509('production', $settings);
    }

    /**
     * when test mode.
     *
     * @param  object $settings
     * @return void
     */
    public function handleComplianceMode(object &$settings): void
    {
        $this->setCert509('compliance', $settings);
    }

    /**
     * set certificate 509 data.
     *
     * @param  string $type     production|compliance
     * @param  object $settings
     * @return array
     */
    protected function setCert509(string $type, object &$settings): void
    {
        $data       = $this->getPostData($type, $settings);
        $headers    = $this->getHeaders($this->seller->otp);
        $route      = $this->getRoute($type);
        $USERPWD    = $this->getUSERPWD($type, $settings);
        $response   = (new PostRequestAction)->handle($route, $data, $headers, $USERPWD);
        $settings->{"cert_{$type}"}     = $response['binarySecurityToken'];
        $settings->{"secret_{$type}"}   = $response['secret'];
        $settings->{"csid_id_{$type}"}  = $response['requestID'];
    }

    /**
     * get post data of request.
     *
     * @param  string $type     production|compliance
     * @param  object $settings
     * @return array
     */
    protected function getPostData(string $type, object $settings): array
    {
        if($type == 'production') {

            return [
                'compliance_request_id' => $settings->csid_id_compliance
            ];

        }

        return [
            'csr' => $settings->csr
        ];
    }

    /**
     * get headers of request.
     *
     * @param  string $otp
     * @return array
     */
    protected function getHeaders(string $otp): array
    {
        return [
            'Accept: application/json',
            'Content-Type: application/json',
            'OTP: ' . $otp,
            'Accept-Version: V2'
        ];
    }

    /**
     * get route of request.
     *
     * @param  string $type
     * @return string
     */
    protected function getRoute(string $type): string
    {
        return ($type == 'production') ? '/production/csids' : '/compliance';
    }

    /**
     * get user & password for authentication.
     *
     * @param  mixed $type
     * @param  mixed $settings
     * @return string
     */
    protected function getUSERPWD(string $type, object $settings): string
    {
        $USERPWD = '';

        if($type == 'production') {
            $USERPWD = $settings->cert_compliance . ":" . $settings->secret_compliance;
        }

        return $USERPWD;
    }
}
