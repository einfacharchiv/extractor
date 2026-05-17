<?php

namespace einfachArchiv\Extractor;

class LabeledDate extends Extraction
{
    /**
     * Extracts dates from lines matching the given labels.
     *
     * @param  array  $labels
     * @return array
     */
    protected function findLabeledDates(array $labels)
    {
        $extractions = [];
        $lines = preg_split('/\R/', $this->text);

        foreach ($lines as $line) {
            if (! $this->lineMatchesAnyLabel($line, $labels)) {
                continue;
            }

            foreach ($this->extractDatesFromLine($line) as $date) {
                $extractions[] = $date;
            }
        }

        return array_values(array_unique($extractions));
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
    protected function extractDatesFromLine($line)
    {
        $extractions = [];
        $patterns = [
            '\b[0-9]{4}-[0-9]{2}-[0-9]{2}\b',
            '\b[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}\b',
            '\b[A-Z][a-z]+ [0-3]?[0-9], [0-9]{4}\b',
        ];

        foreach ($patterns as $pattern) {
            preg_match_all('/'.$pattern.'/u', $line, $matches);

            foreach ($matches[0] as $date) {
                if (strtotime($date) !== false) {
                    $extractions[] = $date;
                }
            }
        }

        return $extractions;
    }
}
