<?php

namespace App\DataProvider\Realm;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\BattleNetDataProvider;
use App\Entity\Realm;

/**
 * Class RealmCollectionDataProvider
 */
class RealmCollectionDataProvider extends BattleNetDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
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
     * @param string $resourceClass
     * @param string|null $operationName
     * @return array
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if ($operationName === 'get') {
            return $this->battleNetSDK->getRealms();
        }

        throw new ResourceClassNotSupportedException();
    }

}
