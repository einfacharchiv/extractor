<?php

namespace einfachArchiv\Extractor\Amount;

use CommerceGuys\Intl\Currency\CurrencyRepository;
use einfachArchiv\Extractor\Extraction;

class De extends Extraction
{
    /**
     * Extracts amounts from the text.
     *
     * @return array
     */
    public function handle()
    {
        $extractions = [];

        preg_match_all('/(-?\b[0-9.]+,[0-9]+) ?(EUR|€)/', $this->text, $matches);

        foreach ($matches[0] as $key => $value) {
            switch ($matches[2][$key]) {
                case '€':
                    $matches[2][$key] = 'EUR';
                    break;
            }

            if (!array_key_exists($matches[2][$key], (new CurrencyRepository())->getList())) {
                continue;
            }

            $extractions[] = [
                'amount' => (float) str_replace(['.', ','], ['', '.'], $matches[1][$key]),
                'currency' => $matches[2][$key],
            ];
        }

        return $extractions;
    }
}
