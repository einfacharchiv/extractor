<?php

namespace einfachArchiv\Extractor;

use IsoCodes\Vat;

class VatNumber extends Extraction
{
    /**
     * Extracts VAT numbers from the text.
     *
     * @return array
     */
    public function handle()
    {
        $extractions = [];

        foreach (Vat::$patterns as $country => $pattern) {
            preg_match_all('/\b'.$country.'(?:'.$pattern.')\b/', $this->text, $matches);

            $extractions = array_merge($extractions, $matches[0]);
        }

        return $extractions;
    }
}
