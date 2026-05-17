<?php

namespace einfachArchiv\Extractor\NetAmount;

use einfachArchiv\Extractor\LabeledAmount;

class De extends LabeledAmount
{
    /**
     * Extracts labeled net amounts from German invoice text.
     *
     * @return array
     */
    public function handle()
    {
        return $this->findLabeledAmounts([
            '\bNettosumme(?:\s+gesamt)?\b',
            '\bNettobetrag\b',
            '\bNetto\b',
        ]);
    }
}
