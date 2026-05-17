<?php

namespace einfachArchiv\Extractor;

class LabeledAmount extends Extraction
{
    /**
     * Extracts currency-qualified amounts from lines matching the given labels.
     *
     * @param  array  $labels
     * @return array
     */
    protected function findLabeledAmounts(array $labels)
    {
        $extractions = [];
        $lines = preg_split('/\R/', $this->text);

        foreach ($lines as $line) {
            if (! $this->lineMatchesAnyLabel($line, $labels)) {
                continue;
            }

            foreach ($this->extractAmountsFromLine($line) as $amount) {
                $extractions[] = $amount;
            }
        }

        return $this->uniqueAmounts($extractions);
    }

    /**
     * @param  string  $line
     * @param  array  $labels
     * @return bool
     */
    protected function lineMatchesAnyLabel($line, array $labels)
    {
        foreach ($labels as $label) {
            if (preg_match('/'.$label.'/iu', $line)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  string  $line
     * @return array
     */
    protected function extractAmountsFromLine($line)
    {
        $extractions = [];
        $currency = '(EUR|USD|GBP|CHF|€|\$|£|\[[A-Z]{3}\])';
        $number = '(-?[0-9]{1,3}(?:[.,][0-9]{3})*(?:[.,][0-9]{2})|-?[0-9]+(?:[.,][0-9]{2}))';

        preg_match_all('/'.$currency.'\s*'.$number.'/u', $line, $prefixMatches, PREG_SET_ORDER);
        foreach ($prefixMatches as $match) {
            $extractions[] = [
                'amount' => $this->normalizeNumber($match[2]),
                'currency' => $this->normalizeCurrency($match[1]),
            ];
        }

        preg_match_all('/'.$number.'\s*'.$currency.'/u', $line, $suffixMatches, PREG_SET_ORDER);
        foreach ($suffixMatches as $match) {
            $extractions[] = [
                'amount' => $this->normalizeNumber($match[1]),
                'currency' => $this->normalizeCurrency($match[2]),
            ];
        }

        return array_values(array_filter($extractions, function ($extraction) {
            return $extraction['amount'] !== null && $extraction['currency'] !== null;
        }));
    }

    /**
     * @param  string  $value
     * @return float|null
     */
    protected function normalizeNumber($value)
    {
        $value = trim(str_replace(' ', '', $value));
        $lastComma = strrpos($value, ',');
        $lastDot = strrpos($value, '.');

        if ($lastComma !== false && ($lastDot === false || $lastComma > $lastDot)) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        } else {
            $value = str_replace(',', '', $value);
        }

        if (! is_numeric($value)) {
            return null;
        }

        return (float) $value;
    }

    /**
     * @param  string  $value
     * @return string|null
     */
    protected function normalizeCurrency($value)
    {
        $value = trim($value, " \t\n\r\0\x0B[]");

        switch ($value) {
            case '€':
                return 'EUR';

            case '$':
                return 'USD';

            case '£':
                return 'GBP';
        }

        return preg_match('/^[A-Z]{3}$/', $value) ? $value : null;
    }

    /**
     * @param  array  $amounts
     * @return array
     */
    protected function uniqueAmounts(array $amounts)
    {
        $seen = [];
        $unique = [];

        foreach ($amounts as $amount) {
            $key = $amount['currency'].':'.number_format($amount['amount'], 2, '.', '');
            if (isset($seen[$key])) {
                continue;
            }

            $seen[$key] = true;
            $unique[] = $amount;
        }

        return $unique;
    }
}
