<?php

namespace einfachArchiv\Extractor\Date;

use einfachArchiv\Extractor\Extraction;

class De extends Extraction
{
    /**
     * Extracts dates from the text.
     *
     * @return array
     */
    public function handle()
    {
        $extractions = [];

        preg_match_all('/\b[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}\b/', $this->text, $matches);

        foreach ($matches[0] as $date) {
            if (false !== strtotime($date)) {
                $extractions[] = $date;
            }
        }

        return $extractions;
    }
}
