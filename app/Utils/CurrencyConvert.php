<?php

namespace App\Utils;

use App\Models\CurrencyRate;

class CurrencyConvert
{
    /**
     * GLOBAL_RATE currency Id is 2
     */
    public const GLOBAL_RATE = 2;  

    /**
     * convertAmountInForeign() Convert currency
     *
     * @param  mixed $amount
     * @return int
     */
    public function convertAmountInForeign($amount): int
    {
        $currencyId = request()->session()->get('business.currency_id');
        $data = $this->getCurrencyRateByExchangeCurrencyId($currencyId);
        if ($data && isset($data->local_currency)) {
            return $amount / $data->local_currency;
        }

        $globalData = $this->getCurrencyRateByExchangeCurrencyId(self::GLOBAL_RATE);
        if ($globalData && isset($globalData->local_currency)) {
            return $amount / $globalData->local_currency;
        }
        return $amount;
    }

    /**
     * getCurrencyRateByExchangeCurrencyId
     *
     * @param  mixed $exchangeCurrencyId
     * @return object
     */
    private function getCurrencyRateByExchangeCurrencyId($exchangeCurrencyId): ?object
    {
        return CurrencyRate::where(['exchange_currency_id'=>$exchangeCurrencyId, 'status'=>1])->first();
    }
}
