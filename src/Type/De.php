<?php

namespace einfachArchiv\Extractor\Type;

use einfachArchiv\Extractor\Extraction;

class De extends Extraction
{
    /**
     * Extracts amounts from the text.
     *
     * @return array
     */
    public function handle()
    {
        $extractions = [];

        preg_match_all('/\b(?:Rechnung|Gutschrift|Mahnung|Lohnauswertung|Abrechnung ?der ?Brutto\/Netto-Bezüge|Kontoauszug|Vertrag|Bilanz|Bescheid)\b/i', $this->text, $matches);

        foreach ($matches[0] as $value) {
            $value = strtolower($value);

            switch ($value) {
                case 'rechnung':
                    $value = 'invoice';
                    break;

                case 'gutschrift':
                    $value = 'credit-note';
                    break;

                case 'mahnung':
                    $value = 'reminder';
                    break;

                case 'lohnauswertung':
                case 'abrechnungderbrutto/netto-bezüge':
                case 'abrechnung der brutto/netto-bezüge':
                    $value = 'salary-statement';
                    break;

                case 'kontoauszug':
                    $value = 'bank-statement';
                    break;

                case 'vertrag':
                    $value = 'contract';
                    break;

                case 'bilanz':
                    $value = 'balance-sheet';
                    break;

                case 'bescheid':
                    $value = 'tax-assessment-note';
                    break;
            }

            $extractions[] = $value;
        }

        return $extractions;
    }
}
