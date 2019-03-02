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

            switch ($value) {
                case 'invoice':
                    $extractions[] = 'invoice';
                    break;

                case 'credit note':
                    $extractions[] = 'credit-note';
                    break;

                case 'reminder':
                    $extractions[] = 'reminder';
                    break;

                case 'salary statement':
                case 'pay slip':
                    $extractions[] = 'salary-statement';
                    break;

                case 'bank statement':
                case 'checking account':
                    $extractions[] = 'bank-statement';
                    break;

                case 'contract':
                    $extractions[] = 'contract';
                    break;

                case 'balance sheet':
                    $extractions[] = 'balance-sheet';
                    break;

                case 'tax assessment note':
                case 'tax return':
                    $extractions[] = 'tax-assessment-note';
                    break;
            }
        }

        return $extractions;
    }
}
