<?php

namespace einfachArchiv\Extractor\TaxAmount;

use einfachArchiv\Extractor\LabeledAmount;

class De extends LabeledAmount
{
    /**
     * Extracts labeled tax amounts from German invoice text.
     *
     * @return array
     */
    public function handle()
    {
        return $this->findLabeledAmounts([
            '\bMwSt\.?\b',
            '\bUSt\.?\b',
            '\bMehrwertsteuer\b',
            '\bUmsatzsteuer\b',
            '\bSteuerbetrag\b',
        ]);
    }
}
