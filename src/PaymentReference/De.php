<?php

namespace einfachArchiv\Extractor\PaymentReference;

use einfachArchiv\Extractor\Extraction;

class De extends Extraction
{
    /**
     * Extracts payment references from the text.
     *
     * @return array
     */
    public function handle()
    {
        preg_match_all("/\bMandatsreferenz:?\s((?:[A-Z0-9]|[\+|\?|\/|\-|:|\(|\)|\.|,|']){1,35})\b/i", $this->text, $matches);

        return $matches[1];
    }
}
