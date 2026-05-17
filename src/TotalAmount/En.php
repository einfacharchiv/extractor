<?php

namespace einfachArchiv\Extractor\TotalAmount;

use einfachArchiv\Extractor\LabeledAmount;

class En extends LabeledAmount
{
    /**
     * Extracts labeled total amounts from English invoice text.
     *
     * @return array
     */
    public function handle()
    {
        return $this->findLabeledAmounts([
            '\bTotal\s+due\b',
            '\bTotal\s+amount\b',
            '\bGrand\s+total\b',
            '\bInvoice\s+total\b',
            '\bAmount\s+due\b',
            '\bBalance\s+due\b',
            '^\s*Total\b(?!\s+(?:VAT|tax|allocated|before|after|excl|incl))',
        ]);
    }
}
