<?php

namespace einfachArchiv\Extractor\InvoiceDate;

use einfachArchiv\Extractor\LabeledDate;

class En extends LabeledDate
{
    /**
     * Extracts invoice dates from English invoice text.
     *
     * @return array
     */
    public function handle()
    {
        return $this->findLabeledDates([
            '\bInvoice\s+date\b',
            '\bIssue\s+date\b',
            '\bDate\s+of\s+invoice\b',
        ]);
    }
}
