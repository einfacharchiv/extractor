<?php

namespace einfachArchiv\Extractor\TaxAmount;

use einfachArchiv\Extractor\LabeledAmount;

class En extends LabeledAmount
{
    /**
     * Extracts labeled tax amounts from English invoice text.
     *
     * @return array
     */
    public function handle()
    {
        return $this->findLabeledAmounts([
            '\bVAT\b',
            '\bSales\s+tax\b',
            '\bTax\s+amount\b',
            '\bTax\b',
        ]);
    }
}
