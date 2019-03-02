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

        preg_match_all('/\b(?:Rechnung|Gutschrift|Mahnung|Lohnauswertung|Abrechnung ?der ?Brutto\/Netto-Bezüge|Kontoauszug|Vertrag|Bilanz|Vorauszahlungsbescheid|Bescheid|Gewerbesteuer)\b/i', $this->text, $matches);

        // Supporting terms
        preg_match_all('/\b(?:Finanzamt|Stadt|Gemeinde)\b/i', $this->text, $supportingMatches);
        $supportingMatches[0] = array_map(function ($term) {
            return strtolower($term);
        }, $supportingMatches[0]);

        foreach ($matches[0] as $value) {
            $value = strtolower($value);

            switch ($value) {
                case 'rechnung':
                    $extractions[] = 'invoice';
                    break;

                case 'gutschrift':
                    $extractions[] = 'credit-note';
                    break;

                case 'mahnung':
                    $extractions[] = 'reminder';
                    break;

                case 'lohnauswertung':
                case 'abrechnungderbrutto/netto-bezüge':
                case 'abrechnung der brutto/netto-bezüge':
                    $extractions[] = 'salary-statement';
                    break;

                case 'kontoauszug':
                    $extractions[] = 'bank-statement';
                    break;

                case 'vertrag':
                    $extractions[] = 'contract';
                    break;

                case 'bilanz':
                    $extractions[] = 'balance-sheet';
                    break;

                case 'vorauszahlungsbescheid':
                case 'bescheid':
                    if (in_array('finanzamt', $supportingMatches[0])) {
                        $extractions[] = 'tax-assessment-note';
                    } else {
                        $extractions[] = 'invoice';
                    }
                    break;

                case 'gewerbesteuer':
                    if (in_array('stadt', $supportingMatches[0]) ||
                        in_array('gemeinde', $supportingMatches[0])) {
                        $extractions[] = 'tax-assessment-note';
                    }
                    break;
            }
        }

        return $extractions;
    }
}
