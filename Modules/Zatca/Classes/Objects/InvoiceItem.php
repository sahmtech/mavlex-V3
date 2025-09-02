<?php

namespace Modules\Zatca\Classes\Objects;

use Modules\Zatca\Classes\TaxCategoryCode;

class InvoiceItem
{
    public $id;

    public $product_name;

    public $quantity;

    public $price;

    public $discount;

    public $tax;

    public $tax_percent;

    public $total;

    public $sub_total;

    public $discount_reason;

    public $tax_category_code;

    public $tax_exemption_reason;

    public $tax_exemption_code;

    public $unit_code;

    public function __construct(
        int     $id,
        string  $product_name,
        float   $quantity,
        float   $price,
        float   $discount,
        float   $tax,
        float   $tax_percent,
        float   $total,
        string  $discount_reason = null,
        string  $tax_category_code = TaxCategoryCode::STANDARD_RATE,
        string  $tax_exemption_reason = null,
        string  $tax_exemption_code = null,
        string  $unit_code = 'PCE',

    ) {
        $this->id                       = $id;
        $this->product_name             = $product_name;
        $this->quantity                 = $quantity;
        $this->price                    = $price;
        $this->discount                 = $discount;
        $this->tax                      = $tax;
        $this->tax_percent              = $tax_percent;
        $this->total                    = $total - $discount;
        $this->sub_total                = $total - $tax - $discount;
        $this->discount_reason          = $discount_reason;
        $this->tax_category_code        = $tax_category_code;
        $this->tax_exemption_reason     = $tax_exemption_reason;
        $this->tax_exemption_code       = $tax_exemption_code;
        $this->unit_code                = $unit_code;
    }

    public function setUnitCode($unit_code): self
    {
        $this->unit_code = $unit_code;

        return $this;
    }
}
