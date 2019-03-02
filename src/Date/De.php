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

        // d.m.Y
        preg_match_all('/\b[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}\b/', $this->text, $matches);

        foreach ($matches[0] as $date) {
            if (false !== strtotime($date)) {
                $extractions[] = $date;
            }
        }

        // d. F Y
        preg_match_all('/\b[0-9]{1,2}\. [A-Z][a-z]+ [0-9]{4}\b/', $this->text, $matches);

        $search = [];
        $replace = [];

        $originalLocale = setlocale(LC_TIME, 0);

        setlocale(LC_TIME, 'de_DE');
        for ($m = 1; $m <= 12; ++$m) {
            $search[] = strftime('%B', mktime(0, 0, 0, $m, 1));
            $search[] = strftime('%b', mktime(0, 0, 0, $m, 1));
        }

        setlocale(LC_TIME, 'en_US');
        for ($m = 1; $m <= 12; ++$m) {
            $replace[] = strftime('%B', mktime(0, 0, 0, $m, 1));
            $replace[] = strftime('%b', mktime(0, 0, 0, $m, 1));
        }

        setlocale(LC_TIME, $originalLocale);

        foreach ($matches[0] as $date) {
            $date = str_replace($search, $replace, $date);

            if (false !== strtotime($date)) {
                $extractions[] = $date;
            }
        }

        return $extractions;
    }
}
