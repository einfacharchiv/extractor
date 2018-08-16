<?php

namespace einfachArchiv\Extractor;

abstract class Extraction
{
    /**
     * The text.
     *
     * @var string
     */
    protected $text;

    /**
     * The locales to search for.
     *
     * @var array
     */
    protected $locales;

    /**
     * @param string $text    The text
     * @param array  $locales The locales to search for
     */
    public function __construct($text, $locales = ['en'])
    {
        $this->text = $text;

        $this->locales = (array) $locales;
    }

    /**
     * Extracts localized data from the text.
     *
     * @return array
     */
    public function handle()
    {
        $extractions = [];

        foreach ($this->locales as $locale) {
            $className = get_class($this).'\\'.ucfirst(strtolower($locale));

            if (class_exists($className)) {
                $extractions = array_merge($extractions, (new $className($this->text, $this->locales))->handle());
            }
        }

        return $extractions;
    }
}
