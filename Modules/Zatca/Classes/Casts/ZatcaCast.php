<?php 

namespace Modules\Zatca\Classes\Casts;

use Modules\Zatca\Classes\Invoices\Invoiceable;

class ZatcaCast
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string   $key
     * @param  string   $value
     * @param  array    $attributes
     * @return \Modules\Zatca\Classes\Invoices\Invoiceable
     */
    public function get($model, $key, $value, $attributes)
    {
        $zatca = json_decode($value);
        if(! is_object($zatca)) {
            return NULL;
        }

        $invoice = new Invoiceable;
        $invoice->setResult((array) $zatca);

        return $invoice;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  \Modules\Zatca\Classes\Invoices\Invoiceable|mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value instanceof Invoiceable 
        ? json_encode($value->getResult()) ?? NULL
        : $attributes[$key] ?? NULL;

    }
}