<?php

namespace einfachArchiv\Extractor\CompanyName;

use einfachArchiv\Extractor\Extraction;

class De extends Extraction
{
    /**
     * Extracts company names from the text.
     *
     * @return array
     */
    public function handle()
    {
        preg_match_all('/\b[A-ZÄÖÜßa-zäöü ]+ (?:GbR\b|OHG\b|GmbH & Co. KG\b|UG & Co. KG\b|KG\b|Unternehmergesellschaft \(haftungsbeschränkt\)|UG \(haftungsbeschränkt\)|UG\b|GmbH\b|AG\b)/', $this->text, $matches);

        return $matches[0];
    }
}
