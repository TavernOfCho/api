<?php

namespace App\DataProvider\Realm;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\BattleNetDataProvider;
use App\Entity\Realm;

class RealmItemDataProvider extends BattleNetDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
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
     * @return array
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if ($operationName === 'get') {
            $id = str_replace("/realms/", "", $context['request_uri']);

            return $this->battleNetSDK->getRealm($id);
        }

        throw new ResourceClassNotSupportedException();

    }
}
