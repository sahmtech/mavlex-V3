<?php

namespace Modules\Zatca\Classes;

class TaxCategoryCode
{
    // This typically applies to most goods and services.
    const STANDARD_RATE = 'S';

    // Certain goods and services are taxed at a 0% rate, meaning no VAT is charged but input VAT can be reclaimed.
    const ZERO_RATE = 'Z';

    // Some goods and services are exempt from VAT altogether.
    const EXEMPT = 'E';

    // Transactions that are not subject to VAT at all, such as certain financial services.
    const OUT_OF_SCOPE = 'O';
}
