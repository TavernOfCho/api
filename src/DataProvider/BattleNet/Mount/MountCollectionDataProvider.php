<?php

namespace App\DataProvider\BattleNet\Mount;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataTransformer\MountTransformer;
use App\Models\Mount;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class MountCollectionDataProvider
 * @property MountTransformer $transformer
 */
class MountCollectionDataProvider extends AbstractBattleNetDataProvider implements CollectionDataProviderInterface
{
    public $model= Mount::class;

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @return array|mixed
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if ($operationName === 'get') {
            $mounts = $this->battleNetSDK->getMounts();
            $mounts = $mounts['mounts'];

            $data = $this->transformer->transformCollection($mounts);
            $collection = new ArrayCollection($data);

            return $this->paginate($collection, $resourceClass, $operationName);
        }

        throw new ResourceClassNotSupportedException();
    }

}
