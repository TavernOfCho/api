<?php

namespace App\DataProvider\BattleNet;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\DataTransformer\TransformerInterface;
use App\Utils\BattleNetSDK;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class BattleNetItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var BattleNetSDK $battleNetSDK */
    protected $battleNetSDK;

    /** @var TransformerInterface $transformer */
    protected $transformer;

    /** @var RequestStack $requestStack */
    protected $requestStack;

    /**
     * BattleNetItemDataProvider constructor.
     * @param BattleNetSDK $battleNetSDK
     * @param TransformerInterface $transformer
     * @param RequestStack $requestStack
     */
    public function __construct(BattleNetSDK $battleNetSDK, TransformerInterface $transformer, RequestStack $requestStack)
    {
        $this->battleNetSDK = $battleNetSDK;
        $this->transformer = $transformer;
        $this->requestStack = $requestStack;
    }
}
