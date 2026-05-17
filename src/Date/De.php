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
        preg_match_all('/\b[0-9]{1,2}\. [[:alpha:].]+ [0-9]{4}\b/u', $this->text, $matches);

        $search = [
            'Januar', 'Jan.',
            'Februar', 'Feb.',
            'März', 'Mär.', 'Mrz.', 'Mär', 'Mrz',
            'April', 'Apr.',
            'Mai',
            'Juni', 'Jun.',
            'Juli', 'Jul.',
            'August', 'Aug.',
            'September', 'Sept.', 'Sep.',
            'Oktober', 'Okt.',
            'November', 'Nov.',
            'Dezember', 'Dez.',
        ];

        $replace = [
            'January', 'Jan',
            'February', 'Feb',
            'March', 'Mar', 'Mar', 'Mar', 'Mar',
            'April', 'Apr',
            'May',
            'June', 'Jun',
            'July', 'Jul',
            'August', 'Aug',
            'September', 'Sep', 'Sep',
            'October', 'Oct',
            'November', 'Nov',
            'December', 'Dec',
        ];

        foreach ($matches[0] as $date) {
            $date = str_ireplace($search, $replace, $date);

            if (false !== strtotime($date)) {
                $extractions[] = $date;
            }
        }

        return $extractions;
    }
}
