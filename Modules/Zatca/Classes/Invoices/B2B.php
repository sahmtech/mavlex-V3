<?php

namespace Modules\Zatca\Classes\Invoices;

use Modules\Zatca\Zatca;
use Modules\Zatca\Classes\Objects\Client;
use Modules\Zatca\Classes\Objects\Seller;
use Modules\Zatca\Classes\Objects\Invoice;
use Modules\Zatca\Classes\Contracts\InvoiceContract;

class B2B extends Invoiceable implements InvoiceContract
{
    protected $seller;
    protected $invoice;
    protected $client;

    public function __construct(Seller $seller, Invoice $invoice, Client $client)
    {
        $this->seller = $seller;
        $this->invoice = $invoice;
        $this->client = $client;
    }

    public static function make(Seller $seller, Invoice $invoice, Client $client): self
    {
        return new self($seller, $invoice, $client);
    }

    public function report(): self
    {
        $this->setResult(Zatca::reportStandardInvoice($this->seller, $this->invoice, $this->client));
        return $this;
    }

    public function calculate(): self
    {
        return $this->report();
    }
}
