<?php

namespace einfachArchiv\Extractor\DueDate;

use einfachArchiv\Extractor\LabeledDate;

class De extends LabeledDate
{
    /**
     * Extracts due dates from German invoice text.
     *
     * @return array
     */
    public function handle()
    {
        return $this->findLabeledDates([
            '\bFällig(?:keit)?(?:sdatum)?\b',
            '\bZahlbar\s+bis\b',
            '\bFällig\s+am\b',
            '\bBitte\s+zahlen\s+Sie\s+bis\b',
        ]);
    }
}
