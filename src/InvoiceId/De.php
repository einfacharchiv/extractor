<?php

namespace einfachArchiv\Extractor\InvoiceId;

use einfachArchiv\Extractor\Extraction;

class De extends Extraction
{
    /**
     * Extracts invoice IDs from the text.
     *
     * @return array
     */
    public function handle()
    {
        preg_match_all('/\b(?:Rechnungsnummer|Rechnungsnr\.?|Rechnung(?:s-?Nr\.?)?|Rechnung|Belegnummer|Belegnr\.?|Beleg)[^\S\r\n]*[:#]?[^\S\r\n]*([0-9A-Z][0-9A-Z._\-\/]*[0-9][0-9A-Z._\-\/]*)\b/i', $this->text, $matches);

        return $matches[1];
    }
}
