<?php

namespace einfachArchiv\Extractor\InvoiceId;

use einfachArchiv\Extractor\Extraction;

class En extends Extraction
{
    /**
     * Extracts invoice IDs from the text.
     *
     * @return array
     */
    public function handle()
    {
        preg_match_all('/\b(?:VAT\s+Invoice\s+Number|Invoice\s+Number|Invoice\s+No\.?|Invoice\s+#|Document\s+Number|Invoice)\s*[:#]?\s*([0-9A-Z][0-9A-Z._\-\/]*[0-9][0-9A-Z._\-\/]*)\b/i', $this->text, $matches);

        return $matches[1];
    }
}
