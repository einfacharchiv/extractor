<?php

namespace einfachArchiv\Extractor\CustomerId;

use einfachArchiv\Extractor\Extraction;

class En extends Extraction
{
    /**
     * Extracts customer IDs from the text.
     *
     * @return array
     */
    public function handle()
    {
        preg_match_all('/\bCustomer ID:?\s+([0-9A-Z-\/]+)\b/', $this->text, $matches);

        return $matches[1];
    }
}
