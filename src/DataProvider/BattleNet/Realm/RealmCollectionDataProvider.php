<?php

namespace App\DataProvider\BattleNet\Realm;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataTransformer\RealmTransformer;
use App\Entity\Realm;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class RealmCollectionDataProvider
 * @property RealmTransformer $transformer
 */
class RealmCollectionDataProvider extends AbstractBattleNetDataProvider implements CollectionDataProviderInterface
{
    public $model= Realm::class;

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @return array|mixed
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if ($operationName === 'get') {
            $realms = $this->battleNetSDK->getRealms();
            $realms = array_map(function ($realm) {
                return $this->battleNetSDK->getRealm($realm['slug']);
            }, $realms['realms']);

            $data = $this->transformer->transformCollection($realms);
            $collection = new ArrayCollection($data);

            return $this->paginate($collection, $resourceClass, $operationName);
        }

        throw new ResourceClassNotSupportedException();
    }

}
