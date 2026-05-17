<?php

namespace einfachArchiv\Extractor\NetAmount;

use einfachArchiv\Extractor\LabeledAmount;

class En extends LabeledAmount
{
    /**
     * Extracts labeled net amounts from English invoice text.
     *
     * @return array
     */
    public function handle()
    {
        return $this->findLabeledAmounts([
            '\bNet\s+amount\b',
            '\bNet\s+total\b',
            '\bSubtotal\b',
            '\bSub-total\b',
        ]);
    }
}
