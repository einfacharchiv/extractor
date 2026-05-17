<?php

namespace einfachArchiv\Extractor\InvoiceDate;

use einfachArchiv\Extractor\LabeledDate;

class De extends LabeledDate
{
    /**
     * Extracts invoice dates from German invoice text.
     *
     * @return array
     */
    public function handle()
    {
        return $this->findLabeledDates([
            '\bRechnungsdatum\b',
            '\bBelegdatum\b',
            '\bDatum\s+der\s+Rechnung\b',
        ]);
    }
}
