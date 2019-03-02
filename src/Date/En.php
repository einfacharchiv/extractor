<?php

namespace einfachArchiv\Extractor\Date;

use einfachArchiv\Extractor\Extraction;

class En extends Extraction
{
    /**
     * Extracts dates from the text.
     *
     * @return array
     */
    public function handle()
    {
        $extractions = [];

        // F d, Y
        preg_match_all('/\b[A-Z][a-z]+ [0-3]?[0-9], [0-9]{4}\b/', $this->text, $matches);

        foreach ($matches[0] as $date) {
            if (false !== strtotime($date)) {
                $extractions[] = $date;
            }
        }

        return $extractions;
    }
}
