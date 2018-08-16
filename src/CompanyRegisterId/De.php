<?php

namespace einfachArchiv\Extractor\CompanyRegisterId;

use einfachArchiv\Extractor\Extraction;

class De extends Extraction
{
    /**
     * Extracts company register IDs from the text.
     *
     * @return array
     */
    public function handle()
    {
        $extractions = [];

        preg_match_all('/\b(?:Amtsgericht|Registergericht):?\s([A-ZÄÖÜß.()-]+)(?:,|\s\/)?\s(HRA|HRB)\s(\d+)\b/i', $this->text, $matches);

        foreach ($matches[0] as $key => $value) {
            $extractions[] = [
                'area' => $matches[2][$key],
                'number' => $matches[3][$key],
                'office' => $matches[1][$key],
            ];
        }

        return $extractions;
    }
}
