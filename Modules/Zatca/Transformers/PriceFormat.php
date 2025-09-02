<?php

namespace Modules\Zatca\Transformers;

class PriceFormat
{
    /**
     * transform the price number to a format.
     *
     * @param  mixed $number
     * @return string
     */
    public static function transform($number): string
    {
        return number_format((float) $number, 2, '.', '');
    }
}
