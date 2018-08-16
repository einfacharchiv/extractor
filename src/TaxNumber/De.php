<?php

namespace einfachArchiv\Extractor\TaxNumber;

use einfachArchiv\Extractor\Extraction;

class De extends Extraction
{
    /**
     * Per state validation rules.
     *
     * @var array
     */
    public static $rules = [
        'BW' => [
            'region' => '(?<ff>\d{2})(?<bbb>\d{3})[\/](?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '28(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'BY' => [
            'region' => '(?<fff>\d{3})[\/](?<bbb>\d{3})[\/](?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '(?<fff>\d{3})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'BE' => [
            'region' => '(?<ff>\d{2})[\/](?<bbb>\d{3})[\/](?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '11(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'BB' => [
            'region' => '0(?<ff>\d{2})[\/](?<bbb>\d{3})[\/](?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '30(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'HB' => [
            'region' => '(?<ff>\d{2})\s(?<bbb>\d{3})\s(?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '24(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'HH' => [
            'region' => '(?<ff>\d{2})[\/](?<bbb>\d{3})[\/](?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '22(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'HE' => [
            'region' => '0(?<ff>\d{2})\s(?<bbb>\d{3})\s(?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '26(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'MV' => [
            'region' => '0(?<ff>\d{2})[\/](?<bbb>\d{3})[\/](?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '40(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'NI' => [
            'region' => '(?<ff>\d{2})[\/](?<bbb>\d{3})[\/](?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '23(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'NW' => [
            'region' => '(?<fff>\d{3})[\/](?<bbbb>\d{4})[\/](?<uuu>\d{3})(?<p>\d{1})',
            'country' => '5(?<fff>\d{3})0(?<bbbb>\d{4})(?<uuu>\d{3})(?<p>\d{1})',
        ],
        'RP' => [
            'region' => '(?<ff>\d{2})[\/](?<bbb>\d{3})[\/](?<uuuu>\d{4})[\/](?<p>\d{1})',
            'country' => '27(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'SL' => [
            'region' => '0(?<ff>\d{2})[\/](?<bbb>\d{3})[\/](?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '10(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'SN' => [
            'region' => '2(?<ff>\d{2})[\/](?<bbb>\d{3})[\/](?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '32(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'ST' => [
            'region' => '1(?<ff>\d{2})[\/](?<bbb>\d{3})[\/](?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '31(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'SH' => [
            'region' => '(?<ff>\d{2})\s(?<bbb>\d{3})\s(?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '21(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
        'TH' => [
            'region' => '1(?<ff>\d{2})[\/](?<bbb>\d{3})[\/](?<uuuu>\d{4})(?<p>\d{1})',
            'country' => '41(?<ff>\d{2})0(?<bbb>\d{3})(?<uuuu>\d{4})(?<p>\d{1})',
        ],
    ];

    /**
     * Extracts tax numbers from the text.
     *
     * @return array
     */
    public function handle()
    {
        $extractions = [];

        foreach (self::$rules as $state => $rules) {
            preg_match_all('/\b(?:Steuernummer|Steuer-Nr.):?\s('.$rules['region'].')\b/i', $this->text, $regionMatches);
            preg_match_all('/\b(?:Steuernummer|Steuer-Nr.):?\s('.$rules['country'].')\b/i', $this->text, $countryMatches);

            $matches = array_merge($regionMatches[1], $countryMatches[1]);

            foreach ($matches as $number) {
                $extractions[] = compact('number', 'state');
            }
        }

        return $extractions;
    }
}
