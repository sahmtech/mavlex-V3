<?php

namespace Modules\Zatca\Classes\Contracts;

interface InvoiceContract
{
    public function report(): self;

    public function calculate(): self;
}
