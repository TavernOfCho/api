<?php

namespace App\Faker\Provider;

use App\Utils\BattleNetSDK;
use Faker\Generator;
use Faker\Provider\Base as BaseProvider;

class BattleNetProvider extends BaseProvider
{
    /** @var BattleNetSDK */
    private $battleNetSDK;

    public function __construct(Generator $generator, BattleNetSDK $battleNetSDK)
    {
        parent::__construct($generator);
        $this->battleNetSDK = $battleNetSDK;
    }

    public function character()
    {
        return self::randomElement(['Aikisugi', 'Zengg', 'Neilo']);
    }

    public function realm()
    {
        $realms = $this->battleNetSDK->getRealms();

        return self::randomElement(array_column($realms['realms'], 'id'));
    }

    public function achievement_id()
    {
        $achievements = $this->battleNetSDK->getAchievements();

        return self::randomElement(array_column($achievements['achievements'], 'id'));
    }
}
