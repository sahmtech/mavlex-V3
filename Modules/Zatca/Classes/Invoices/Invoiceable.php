<?php

namespace Modules\Zatca\Classes\Invoices;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;

use Modules\Zatca\Classes\Actions\GetQrFromInvoice;

class Invoiceable
{
    private $result;

    public function setResult($result): void
    {
        $this->result = $result;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function getClearedInvoice(): string
    {
        return $this->getResult()['clearedInvoice'];
    }

    public function getXmlInvoice(): string
    {
        return base64_decode($this->getClearedInvoice());
    }

    public function getInvoiceHash(): string
    {
        return $this->getResult()['invoiceHash'];
    }

    public function getReportingStatus(): string
    {
        return $this->getResult()['reportingStatus'];
    }

    public function getValidationResults(): array
    {
        return $this->getResult()['validationResults'];
    }

    public function getInfoMessages(): array
    {
        return $this->getValidationResults()['infoMessages'];
    }

    public function getWarningMessages(): array
    {
        return $this->getValidationResults()['warningMessages'];
    }

    public function getErrorMessages(): array
    {
        return $this->getValidationResults()['errorMessages'];
    }

    public function getValidationResultStatus(): string
    {
        return $this->getValidationResults()['status'];
    }

    public function getQr(): string
    {
        return (new GetQrFromInvoice)->handle($this->getClearedInvoice());
    }

    public function getQrImage(): string
    {
        return \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate($this->getQr())->toHtml();
    }

    public function getQrImageNatively(): string
    {
        return \Endroid\QrCode\Builder\Builder::create()
            ->writer(new \Endroid\QrCode\Writer\PngWriter())
            ->writerOptions([])
            ->data($this->getQr())
            ->encoding(new \Endroid\QrCode\Encoding\Encoding('UTF-8'))
            ->errorCorrectionLevel(new \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow)
            ->size(150)
            ->margin(0)
            ->roundBlockSizeMode(new \Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeNone)
            ->build()
            ->getDataUri();
    }
}
