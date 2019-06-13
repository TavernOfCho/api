<?php

namespace App\DataProvider\Traits;

use App\Utils\Locale;

trait LocaleFilterTrait
{
    /** @var Locale $locale */
    private $locale;

    /**
     * @return Locale
     */
    public function getLocale(): Locale
    {
        return $this->locale;
    }

    /**
     * @param Locale $locale
     * @return LocaleFilterTrait
     */
    public function setLocale(Locale $locale): self
    {
        $this->locale = $locale;

        return $this;
    }
}
