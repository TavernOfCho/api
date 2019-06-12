<?php

namespace App\Tests\Utils;

use App\Utils\BattleNetSDK;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BattleNetSDKTest extends WebTestCase
{
    /** @var BattleNetSDK $battleNetSDK */
    private $battleNetSDK;

    protected function setUp()
    {
        parent::setUp();
        static::bootKernel();
        $this->battleNetSDK = self::$container->get(BattleNetSDK::class);
    }

    public function testGetRealms()
    {
        $realms = $this->battleNetSDK->getRealms();
        $this->assertArrayHasKey('realms', $realms);

        foreach ($realms['realms'] as $realm) {
            $this->assertArrayHasKey('key', $realm);
            $this->assertArrayHasKey('href', $realm['key']);
            $this->assertArrayHasKey('name', $realm);
            $this->assertArrayHasKey('id', $realm);
            $this->assertArrayHasKey('slug', $realm);
        }
    }

    /**
     * @param string $realm
     * @dataProvider providerRealm
     */
    public function testGetRealm(string $realm)
    {
        $realm = $this->battleNetSDK->getRealm($realm);
        $this->assertArrayHasKey('id', $realm);
        $this->assertArrayHasKey('region', $realm);
        $this->assertArrayHasKey('name', $realm);
        $this->assertArrayHasKey('category', $realm);
        $this->assertArrayHasKey('locale', $realm);
        $this->assertArrayHasKey('timezone', $realm);
        $this->assertArrayHasKey('slug', $realm);
    }

    /**
     * @param string $name
     * @param string $realm
     * @dataProvider providerCharacter
     */
    public function testGetCharacter(string $name, string $realm)
    {
        $character = $this->battleNetSDK->getCharacter($name, $realm);
        $this->assertArrayHasKey('name', $character);
        $this->assertArrayHasKey('realm', $character);
        $this->assertArrayHasKey('class', $character);
        $this->assertArrayHasKey('race', $character);
        $this->assertArrayHasKey('gender', $character);
        $this->assertArrayHasKey('level', $character);
        $this->assertArrayHasKey('faction', $character);
    }

    /**
     * @param string $name
     * @param string $realm
     * @dataProvider providerCharacter
     */
    public function testGetCharacterAchievements(string $name, string $realm)
    {
        $character = $this->battleNetSDK->getCharacter($name, $realm, 'achievements');

        $this->assertArrayHasKey('achievements', $character);
        $achievements = $character['achievements'];

        $this->assertArrayHasKey('achievementsCompleted', $achievements);
        $this->assertArrayHasKey('achievementsCompletedTimestamp', $achievements);
        $this->assertArrayHasKey('criteria', $achievements);
        $this->assertArrayHasKey('criteriaQuantity', $achievements);
        $this->assertArrayHasKey('criteriaTimestamp', $achievements);
        $this->assertArrayHasKey('criteriaCreated', $achievements);
    }

    /**
     * @param string $name
     * @param string $realm
     * @dataProvider providerCharacter
     */
    public function testGetCharacterFeed(string $name, string $realm)
    {
        $character = $this->battleNetSDK->getCharacter($name, $realm, 'feed');

        $this->assertArrayHasKey('feed', $character);
        $feeds = $character['feed'];

        foreach ($feeds as $feed) {
            $this->assertArrayHasKey('type', $feed);
            $this->assertArrayHasKey('timestamp', $feed);
        }
    }

    /**
     * @param string $name
     * @param string $realm
     * @dataProvider providerCharacter
     */
    public function testGetCharacterReputation(string $name, string $realm)
    {
        $character = $this->battleNetSDK->getCharacter($name, $realm, 'reputation');

        $this->assertArrayHasKey('reputation', $character);
        $reputations = $character['reputation'];

        foreach ($reputations as $reputation) {
            $this->assertArrayHasKey('id', $reputation);
            $this->assertArrayHasKey('name', $reputation);
            $this->assertArrayHasKey('standing', $reputation);
            $this->assertArrayHasKey('value', $reputation);
            $this->assertArrayHasKey('max', $reputation);
        }

    }

    /**
     * @param string $name
     * @param string $realm
     * @dataProvider providerCharacter
     */
    public function testGetCharacterGuild(string $name, string $realm)
    {
        $character = $this->battleNetSDK->getCharacter($name, $realm, 'guild');

        $this->assertArrayHasKey('guild', $character);
        $guild = $character['guild'];

        $this->assertArrayHasKey('name', $guild);
        $this->assertArrayHasKey('realm', $guild);
        $this->assertArrayHasKey('members', $guild);
        $this->assertArrayHasKey('emblem', $guild);
    }

    /**
     * @param string $name
     * @param string $realm
     * @dataProvider providerCharacter
     */
    public function testGetCharacterItems(string $name, string $realm)
    {
        $character = $this->battleNetSDK->getCharacter($name, $realm, 'items');

        $this->assertArrayHasKey('items', $character);
        $items = $character['items'];

        $this->assertArrayHasKey('averageItemLevel', $items);
        $this->assertArrayHasKey('averageItemLevelEquipped', $items);
        $this->assertArrayHasKey('head', $items);
        $this->assertArrayHasKey('neck', $items);
        $this->assertArrayHasKey('shoulder', $items);
        $this->assertArrayHasKey('back', $items);
        $this->assertArrayHasKey('chest', $items);
        $this->assertArrayHasKey('tabard', $items);
        $this->assertArrayHasKey('wrist', $items);
        $this->assertArrayHasKey('hands', $items);
        $this->assertArrayHasKey('waist', $items);
        $this->assertArrayHasKey('legs', $items);
        $this->assertArrayHasKey('feet', $items);
        $this->assertArrayHasKey('finger1', $items);
        $this->assertArrayHasKey('finger2', $items);
        $this->assertArrayHasKey('trinket1', $items);
        $this->assertArrayHasKey('trinket2', $items);
        $this->assertArrayHasKey('mainHand', $items);
        $this->assertArrayHasKey('offHand', $items);
    }

    /**
     * @param string $name
     * @param string $realm
     * @dataProvider providerCharacter
     */
    public function testGetCharacterStats(string $name, string $realm)
    {
        $character = $this->battleNetSDK->getCharacter($name, $realm, 'stats');

        $this->assertArrayHasKey('stats', $character);
        $stats = $character['stats'];

        $this->assertArrayHasKey('health', $stats);
        $this->assertArrayHasKey('powerType', $stats);
        $this->assertArrayHasKey('power', $stats);
        $this->assertArrayHasKey('str', $stats);
        $this->assertArrayHasKey('agi', $stats);
        $this->assertArrayHasKey('int', $stats);
        $this->assertArrayHasKey('sta', $stats);
        $this->assertArrayHasKey('speedRating', $stats);
        $this->assertArrayHasKey('speedRatingBonus', $stats);
        $this->assertArrayHasKey('crit', $stats);
        $this->assertArrayHasKey('critRating', $stats);
        $this->assertArrayHasKey('haste', $stats);
        $this->assertArrayHasKey('hasteRating', $stats);
        $this->assertArrayHasKey('hasteRatingPercent', $stats);
        $this->assertArrayHasKey('mastery', $stats);
        $this->assertArrayHasKey('masteryRating', $stats);
        $this->assertArrayHasKey('leech', $stats);
        $this->assertArrayHasKey('leechRating', $stats);
        $this->assertArrayHasKey('leechRatingBonus', $stats);
    }

    /**
     * @param string $name
     * @param string $realm
     * @dataProvider providerCharacter
     */
    public function testGetCharacterPets(string $name, string $realm)
    {
        $character = $this->battleNetSDK->getCharacter($name, $realm, 'pets');

        $this->assertArrayHasKey('pets', $character);
        $pets = $character['pets'];

        $this->assertArrayHasKey('numCollected', $pets);
        $this->assertArrayHasKey('numNotCollected', $pets);
        $this->assertArrayHasKey('collected', $pets);
    }

    /**
     * @param string $name
     * @param string $realm
     * @dataProvider providerCharacter
     */
    public function testGetCharacterMounts(string $name, string $realm)
    {
        $character = $this->battleNetSDK->getCharacter($name, $realm, 'mounts');

        $this->assertArrayHasKey('mounts', $character);
        $mounts = $character['mounts'];

        $this->assertArrayHasKey('numCollected', $mounts);
        $this->assertArrayHasKey('numNotCollected', $mounts);
        $this->assertArrayHasKey('collected', $mounts);
    }


    public function testGetCharacterClasses()
    {
        $classes = $this->battleNetSDK->getCharacterClasses();
        $this->assertArrayHasKey('classes', $classes);

        $classes = $classes['classes'];
        $this->assertGreaterThan(10, count($classes));

        foreach ($classes as $class) {
            $this->assertArrayHasKey('id', $class);
            $this->assertArrayHasKey('mask', $class);
            $this->assertArrayHasKey('powerType', $class);
            $this->assertArrayHasKey('name', $class);
        }
    }

    public function testGetCharacterRaces()
    {
        $races = $this->battleNetSDK->getCharacterRaces();
        $this->assertArrayHasKey('races', $races);

        $races = $races['races'];
        $this->assertGreaterThan(10, count($races));

        foreach ($races as $race) {
            $this->assertArrayHasKey('id', $race);
            $this->assertArrayHasKey('mask', $race);
            $this->assertArrayHasKey('side', $race);
            $this->assertArrayHasKey('name', $race);
        }
    }

    /**
     * @param int $achievement
     * @dataProvider providerAchievements
     */
    public function testGetAchievement(int $achievement)
    {
        $achievement = $this->battleNetSDK->getAchievement($achievement);

        $this->assertArrayHasKey('id', $achievement);
        $this->assertArrayHasKey('title', $achievement);
        $this->assertArrayHasKey('points', $achievement);
        $this->assertArrayHasKey('description', $achievement);
        $this->assertArrayHasKey('rewardItems', $achievement);
        $this->assertArrayHasKey('icon', $achievement);
        $this->assertArrayHasKey('criteria', $achievement);
        $this->assertArrayHasKey('accountWide', $achievement);
        $this->assertArrayHasKey('factionId', $achievement);
    }

    public function testGetAchievements()
    {
        $achievements = $this->battleNetSDK->getAchievements();
        $this->assertArrayHasKey('achievements', $achievements);

        $achievements = $achievements['achievements'];

        foreach ($achievements as $group) {
            $this->assertArrayHasKey('id', $group);
            $this->assertArrayHasKey('name', $group);
        }
    }

    public function providerRealm()
    {
        return [
            ['goldrinn'],
            ['grom'],
            ['blackscar'],
            ['thermaplugg'],
            ['eversong']
        ];
    }

    public function providerCharacter()
    {
        return [
            ['Zengg', 'Dalaran'],
            ['Genz', 'Dalaran'],
        ];
    }

    public function providerAchievements()
    {
        return [
            [15],
            [9126]
        ];
    }

}
