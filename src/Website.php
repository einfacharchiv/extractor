<?php

namespace einfachArchiv\Extractor;

class Website extends Extraction
{
    /**
     * Extracts websites from the text.
     *
     * @return array
     */
    public function handle()
    {
        preg_match_all('/\b(?:(?:https|http|ftp):\/\/|www\.)[-a-z0-9+&@#\/%=~_|$?!:,.]*[a-z0-9+&@#\/%=~_|$]\b/', $this->text, $matches);

        return $matches[0];
    }
}
