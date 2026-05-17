<?php

namespace einfachArchiv\Extractor\DueDate;

use einfachArchiv\Extractor\LabeledDate;

class En extends LabeledDate
{
    /**
     * Extracts due dates from English invoice text.
     *
     * @return array
     */
    public function handle()
    {
        return $this->findLabeledDates([
            '\bDue\s+date\b',
            '\bPayment\s+due\b',
            '\bPayable\s+by\b',
            '\bPlease\s+pay\s+by\b',
        ]);
    }
}
