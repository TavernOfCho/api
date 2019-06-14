<?php

namespace App\Tests\Utils;

use App\Utils\Locale;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LocaleTest extends WebTestCase
{
    /** @var Locale */
    private $localeService;

    protected function setUp()
    {
        parent::setUp();
        static::bootKernel();
        $this->localeService = static::$container->get(Locale::class);
    }

    public function testGetLocale()
    {
        $this->assertTrue(is_string($this->localeService->getLocale()));
    }

    public function testGetDefaultLocale()
    {
        $this->assertTrue(is_string($this->localeService->getDefaultLocale()));
    }

    public function testIsDefaultLocale()
    {
        $this->assertTrue(is_bool($this->localeService->isDefaultLocale()));
    }

    public function testGetShortLocale()
    {
        $this->assertTrue(is_string($this->localeService->getShortLocale()));
    }
}
