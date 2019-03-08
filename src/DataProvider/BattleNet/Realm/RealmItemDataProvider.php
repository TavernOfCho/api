<?php

namespace App\DataProvider\BattleNet\Realm;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataTransformer\RealmTransformer;
use App\Models\Realm;

/**
 * Class RealmItemDataProvider
 * @property RealmTransformer $transformer
 */
class RealmItemDataProvider extends AbstractBattleNetDataProvider implements ItemDataProviderInterface
{
    public $model = Realm::class;

    /**
     * Retrieves an item.
     *
     * @param string $resourceClass
     * @param array|int|string $id
     *
     * @param string|null $operationName
     * @param array $context
     * @return Realm
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Realm
    {
        if ($operationName === 'get') {
            return $this->transformer->transformItem($this->battleNetSDK->getRealm(strtolower($id)));
        }

        throw new ResourceClassNotSupportedException();
    }

    public function configure()
    {
        $this->setTransformer(new RealmTransformer());
    }


}
