<?php

namespace App\Tests\Utils;

use App\Utils\Locale;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LocaleTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();
        static::bootKernel();
    }

    public function testGetLocale()
    {
        $this->assertTrue(is_string(static::$container->get(Locale::class)->getLocale()));
    }
}
