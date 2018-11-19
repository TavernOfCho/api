<?php
namespace App\DataProvider\BattleNet;

use App\Utils\BattleNetSDK;

abstract class BattleNetDataProvider
{
    /** @var BattleNetSDK $battleNetSDK */
    protected $battleNetSDK;

    /**
     * AbstractBattleNetDataProvider constructor.
     * @param BattleNetSDK $battleNetSDK
     */
    public function __construct(BattleNetSDK $battleNetSDK)
    {
        $this->battleNetSDK = $battleNetSDK;
    }

}
