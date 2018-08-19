<?php

namespace einfachArchiv\Extractor\CompanyName;

use einfachArchiv\Extractor\Extraction;

class En extends Extraction
{
    /**
     * Extracts company names from the text.
     *
     * @return array
     */
    public function handle()
    {
        preg_match_all('/\b[A-Za-z ]+ (?:GP\b|LLP\b|LP\b|Corp\.|Inc\.|Ltd\.|LC\b|LLC\b)/', $this->text, $matches);

        return $matches[0];
    }
}
