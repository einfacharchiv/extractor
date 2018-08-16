<?php

namespace einfachArchiv\Extractor\Type;

use einfachArchiv\Extractor\Extraction;

class En extends Extraction
{
    /**
     * Extracts amounts from the text.
     *
     * @return array
     */
    public function handle()
    {
        $extractions = [];

        preg_match_all('/\b(?:Invoice|Credit Note|Reminder|Salary Statement|Pay Slip|Bank Statement|Checking Account|Contract|Balance Sheet|Tax Assessment Note|Tax Return)\b/i', $this->text, $matches);

        foreach ($matches[0] as $value) {
            $value = strtolower($value);

            $value = str_replace(' ', '-', $value);

            switch ($value) {
                case 'pay-slip':
                    $value = 'salary-statement';
                    break;

                case 'checking-account':
                    $value = 'bank-statement';
                    break;

                case 'tax-return':
                    $value = 'tax-assessment-note';
                    break;
            }

            $extractions[] = $value;
        }

        return $extractions;
    }
}
