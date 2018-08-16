<?php

namespace einfachArchiv\Extractor\ReferenceId;

use einfachArchiv\Extractor\Extraction;

class De extends Extraction
{
    /**
     * Extracts reference IDs from the text.
     *
     * @return array
     */
    public function handle()
    {
        preg_match_all("/\bMandatsreferenz:?\s((?:[A-Z0-9]|[\+|\?|\/|\-|:|\(|\)|\.|,|']){1,35})\b/i", $this->text, $matches);

        return $matches[1];
    }
}
