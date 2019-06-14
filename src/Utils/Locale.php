<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\RequestStack;

class Locale
{
    /** @var string $locale */
    private $locale;
    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * Locale constructor.
     * @param RequestStack $requestStack
     * @param string $defaultLocale
     */
    public function __construct(RequestStack $requestStack, string $defaultLocale)
    {
        $request = $requestStack->getCurrentRequest();
        $this->locale = $request ? $request->getLocale() : $defaultLocale;
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getDefaultLocale(): string
    {
        return $this->defaultLocale;
    }

    /**
     * @return bool
     */
    public function isDefaultLocale()
    {
        return $this->getLocale() === $this->getDefaultLocale();
    }

    /**
     * @return string
     */
    public function getShortLocale(): string
    {
        return str_replace("_", "", $this->getLocale());
    }
}
