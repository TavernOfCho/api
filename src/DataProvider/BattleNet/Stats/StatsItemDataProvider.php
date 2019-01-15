<?php

namespace App\DataProvider\BattleNet\Stats;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataProvider\Traits\RealmFilterTrait;
use App\DataTransformer\StatsTransformer;
use App\Entity\Stats;

/**
 * Class StatsItemDataProvider
 * @property StatsTransformer $transformer
 */
class StatsItemDataProvider extends AbstractBattleNetDataProvider implements ItemDataProviderInterface
{
    use RealmFilterTrait;

    public $model= Stats::class;

    /**
     * Retrieves an item.
     *
     * @param string $resourceClass
     * @param array|int|string $id
     *
     * @param string|null $operationName
     * @param array $context
     * @return Stats
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Stats
    {
        if ($operationName === 'character_stats') {
            $realm = $this->getRealm();

            $character = $this->battleNetSDK->getCharacter($id, $realm, 'stats');
            $character['stats']['name'] = $character['name'];

            return $this->transformer->transformItem($character['stats']);
        }

        throw new ResourceClassNotSupportedException();
    }
}
