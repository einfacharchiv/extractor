<?php

namespace einfachArchiv\Extractor\Amount;

use CommerceGuys\Intl\Currency\CurrencyRepository;
use einfachArchiv\Extractor\Extraction;

class En extends Extraction
{
    /**
     * Extracts amounts from the text.
     *
     * @return array
     */
    public function handle()
    {
        $extractions = [];

        preg_match_all('/(\b[A-Z]{3}|\$|£|€) ?(-?[0-9,]+\.[0-9]+)\b/', $this->text, $matches);

        foreach ($matches[0] as $key => $value) {
            switch ($matches[1][$key]) {
                case '$':
                    $matches[1][$key] = 'USD';
                    break;

                case '£':
                    $matches[1][$key] = 'GBP';
                    break;

                case '€':
                    $matches[1][$key] = 'EUR';
                    break;
            }

            if (!array_key_exists($matches[1][$key], (new CurrencyRepository())->getList())) {
                continue;
            }

            $extractions[] = [
                'amount' => (float) str_replace(',', '', $matches[2][$key]),
                'currency' => $matches[1][$key],
            ];
        }

        return $extractions;
    }
}
