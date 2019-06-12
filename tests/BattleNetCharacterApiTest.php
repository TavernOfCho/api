<?php


namespace App\Tests;

class BattleNetCharacterApiTest extends WebTestCase
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

    protected function characterUrl(string $url, string $username, string $realm)
    {
        return strtr($url, ['{username}' => $username, '{realm}' => $realm]);
    }

}
