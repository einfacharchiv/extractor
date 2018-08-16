<?php

namespace einfachArchiv\Extractor;

use League\ISO3166\ISO3166;

class Bic extends Extraction
{
    /**
     * Extracts BICs from the text.
     *
     * @return array
     */
    public function handle()
    {
        $extractions = [];

        foreach ((new ISO3166())->iterator() as $country) {
            preg_match_all('/\b[A-Z]{4}'.$country['alpha2'].'[0-9A-Z]{2}[0-9A-Z]{3}?\b/', $this->text, $matches);

            $extractions = array_merge($extractions, $matches[0]);
        }

        return $extractions;
    }
}
