<?php

namespace App\DataProvider\BattleNet\Realm;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\BattleNetItemDataProvider;
use App\Entity\Realm;

class RealmItemDataProvider extends BattleNetItemDataProvider
{
    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Realm::class === $resourceClass;
    }

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
            return $this->transformer->transformItem($this->battleNetSDK->getRealm($id));
        }

        throw new ResourceClassNotSupportedException();
    }
}
