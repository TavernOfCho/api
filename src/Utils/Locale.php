<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\RequestStack;

class Locale
{
    /** @var string $locale */
    private $locale;

    /**
     * Locale constructor.
     * @param RequestStack $requestStack
     * @param string $defaultLocale
     */
    public function __construct(RequestStack $requestStack, string $defaultLocale)
    {
        $request = $requestStack->getCurrentRequest();
        $this->locale = $request ? $request->getLocale() : $defaultLocale;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }
}
