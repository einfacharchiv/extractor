<?php

namespace einfachArchiv\Extractor\TotalAmount;

use einfachArchiv\Extractor\LabeledAmount;

class De extends LabeledAmount
{
    /**
     * Extracts labeled total amounts from German invoice text.
     *
     * @return array
     */
    public function handle()
    {
        return $this->findLabeledAmounts([
            '\bBruttosumme(?:\s+gesamt)?\b',
            '\bBruttobetrag\b',
            '\bGesamtbetrag\b',
            '\bRechnungsbetrag\b',
            '\bEndbetrag\b',
            '\bZahlbetrag\b',
            '\bZu\s+zahlen\b',
        ]);
    }
}
