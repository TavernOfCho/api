<?php

namespace App\Tests;

class BattleNetBaseApiTest extends WebTestCase
{
    public function testRetrieveClasses()
    {
        $response = $this->request('GET', '/classes');
        $json = json_decode($response->getContent(), true);
        $this->assertCollectionOperation($response, $json, true);
    }

    public function testRetrieveMounts()
    {
        $response = $this->request('GET', '/mounts');
        $json = json_decode($response->getContent(), true);
        $this->assertCollectionOperation($response, $json);
    }

    public function testRetrieveRaces()
    {
        $response = $this->request('GET', '/races');
        $json = json_decode($response->getContent(), true);
        $this->assertCollectionOperation($response, $json, true);
    }

    public function testRetrieveRealms()
    {
        $response = $this->request('GET', '/realms');
        $json = json_decode($response->getContent(), true);
        $this->assertCollectionOperation($response, $json);
    }

    /**
     * @dataProvider provider
     * @param string $realm
     */
    public function testRetrieveRealm(string $realm)
    {
        $response = $this->request('GET', sprintf('/realms/%s', $realm));
        $json = json_decode($response->getContent(), true);
        $this->assertItemOperation($response, $json);
    }

    public function provider()
    {
        return [
            ['Dalaran']
        ];
    }

}
