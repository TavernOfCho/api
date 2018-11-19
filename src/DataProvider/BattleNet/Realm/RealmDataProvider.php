<?php
/**
 * Created by PhpStorm.
 * User: fma
 * Date: 19/11/18
 * Time: 16:42
 */

namespace App\DataProvider\BattleNet\Realm;


use App\DataProvider\BattleNet\BattleNetDataProvider;
use App\DataTransformer\RealmTransformer;
use App\Utils\BattleNetSDK;

abstract class RealmDataProvider extends BattleNetDataProvider
{
    /** @var RealmTransformer $transformer */
    protected $transformer;

    /**
     * RealmDataProvider constructor.
     * @param BattleNetSDK $battleNetSDK
     * @param RealmTransformer $transformer
     */
    public function __construct(BattleNetSDK $battleNetSDK, RealmTransformer $transformer)
    {
        parent::__construct($battleNetSDK);
        $this->transformer = $transformer;
    }
}
