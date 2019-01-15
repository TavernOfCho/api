<?php

namespace App\DataProvider\BattleNet\Achievement;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataTransformer\ItemsTransformer;
use App\Entity\Achievement;

/**
 * Class AchievementItemDataProvider
 * @property ItemsTransformer $transformer
 */
class AchievementItemDataProvider extends AbstractBattleNetDataProvider implements ItemDataProviderInterface
{
    public $model= Achievement::class;

    /**
     * Retrieves an item.
     *
     * @param string $resourceClass
     * @param array|int|string $id
     *
     * @param string|null $operationName
     * @param array $context
     * @return Achievement
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Achievement
    {
        if ($operationName === 'get') {
            return $this->transformer->transformItem($this->battleNetSDK->getAchievement($id));
        }

        throw new ResourceClassNotSupportedException();
    }
}
