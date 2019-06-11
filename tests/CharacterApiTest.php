<?php


namespace App\Tests;

use Symfony\Component\HttpFoundation\Response;

class CharacterApiTest extends WebTestCase
{

    /**
     * @dataProvider provider
     * @param string $username
     * @param string $realm
     */
    public function testRetrieveCharacterAchievementCompleted(string $username, string $realm)
    {
        $response = $this->request('GET', $this->characterUrl('/characters/{username}/{realm}/achievements/completed', $username, $realm));
        $json = json_decode($response->getContent(), true);
        $this->assertCollectionOperation($response, $json);
    }

    /**
     * @dataProvider provider
     * @param string $username
     * @param string $realm
     */
    public function testRetrieveCharacterAchievement(string $username, string $realm)
    {
        $response = $this->request('GET', $this->characterUrl('/characters/{username}/{realm}/achievements', $username, $realm));
        $json = json_decode($response->getContent(), true);
        $this->assertCollectionOperation($response, $json);
    }

    /**
     * @dataProvider provider
     * @param string $username
     * @param string $realm
     */
    public function testRetrieveCharacter(string $username, string $realm)
    {
        $response = $this->request('GET', $this->characterUrl('/characters/{username}?realm={realm}', $username, $realm));
        $json = json_decode($response->getContent(), true);
        $this->assertItemOperation($response, $json);
    }

    /**
     * @dataProvider provider
     * @param string $username
     * @param string $realm
     */
    public function testRetrieveCharacterFeed(string $username, string $realm)
    {
        $response = $this->request('GET', $this->characterUrl('/characters/{username}/{realm}/feeds', $username, $realm));
        $json = json_decode($response->getContent(), true);
        $this->assertItemOperation($response, $json);
    }

    /**
     * @dataProvider provider
     * @param string $username
     * @param string $realm
     */
    public function testRetrieveCharacterGuild(string $username, string $realm)
    {
        $response = $this->request('GET', $this->characterUrl('/characters/{username}/{realm}/guild', $username, $realm));
        $json = json_decode($response->getContent(), true);
        $this->assertItemOperation($response, $json);
    }

    /**
     * @dataProvider provider
     * @param string $username
     * @param string $realm
     */
    public function testRetrieveCharacterItems(string $username, string $realm)
    {
        $response = $this->request('GET', $this->characterUrl('/characters/{username}/{realm}/items', $username, $realm));
        $json = json_decode($response->getContent(), true);
        $this->assertItemOperation($response, $json);
    }

    /**
     * @dataProvider provider
     * @param string $username
     * @param string $realm
     */
    public function testRetrieveCharacterMounts(string $username, string $realm)
    {
        $response = $this->request('GET', $this->characterUrl('/characters/{username}/{realm}/mounts', $username, $realm));
        $json = json_decode($response->getContent(), true);
        $this->assertItemOperation($response, $json);
    }

    /**
     * @dataProvider provider
     * @param string $username
     * @param string $realm
     */
    public function testRetrieveCharacterPets(string $username, string $realm)
    {
        $response = $this->request('GET', $this->characterUrl('/characters/{username}/{realm}/pets', $username, $realm));
        $json = json_decode($response->getContent(), true);
        $this->assertItemOperation($response, $json);
    }

    /**
     * @dataProvider provider
     * @param string $username
     * @param string $realm
     */
    public function testRetrieveCharacterReputations(string $username, string $realm)
    {
        $response = $this->request('GET', $this->characterUrl('/characters/{username}/{realm}/reputations', $username, $realm));
        $json = json_decode($response->getContent(), true);
        $this->assertCollectionOperation($response, $json);
    }

    /**
     * @dataProvider provider
     * @param string $username
     * @param string $realm
     */
    public function testRetrieveCharacterStats(string $username, string $realm)
    {
        $response = $this->request('GET', $this->characterUrl('/characters/{username}/{realm}/stats', $username, $realm));
        $json = json_decode($response->getContent(), true);
        $this->assertItemOperation($response, $json);
    }

    public function provider()
    {
        return [
            ['Zengg', 'Dalaran']
        ];
    }

    protected function assertCollectionOperation(Response $response, array $json)
    {
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('hydra:totalItems', $json);
        $this->assertGreaterThan(0, $json['hydra:totalItems']);

        $this->assertArrayHasKey('hydra:member', $json);
        $this->assertCount(30, $json['hydra:member']);
    }

    protected function assertItemOperation(Response $response, array $json)
    {
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('@context', $json);
        $this->assertArrayHasKey('@id', $json);
        $this->assertArrayHasKey('@type', $json);
    }

    protected function characterUrl(string $url, string $username, string $realm)
    {
        return strtr($url, ['{username}' => $username, '{realm}' => $realm]);
    }

}
