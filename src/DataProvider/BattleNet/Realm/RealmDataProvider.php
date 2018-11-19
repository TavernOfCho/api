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
use Symfony\Component\HttpFoundation\RequestStack;

abstract class RealmDataProvider extends BattleNetDataProvider
{
    /** @var RealmTransformer $transformer */
    protected $transformer;

    /** @var RequestStack $requestStack */
    protected $requestStack;

    /**
     * RealmDataProvider constructor.
     * @param BattleNetSDK $battleNetSDK
     * @param RealmTransformer $transformer
     * @param RequestStack $requestStack
     */
    public function __construct(BattleNetSDK $battleNetSDK, RealmTransformer $transformer, RequestStack $requestStack)
    {
        parent::__construct($battleNetSDK);
        $this->transformer = $transformer;
        $this->requestStack = $requestStack;
    }
}
