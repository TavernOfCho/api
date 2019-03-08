<?php

namespace App\DataProvider\BattleNet\Classes;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataTransformer\ClassesTransformer;
use App\Models\Classes;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class RealmCollectionDataProvider
 * @property ClassesTransformer $transformer
 */
class ClassesCollectionDataProvider extends AbstractBattleNetDataProvider implements CollectionDataProviderInterface
{
    public $model= Classes::class;

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @return array|mixed
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if ($operationName === 'get') {
            $classes = $this->battleNetSDK->getCharacterClasses();
            $classes = $classes['classes'];

            $data = $this->transformer->transformCollection($classes);
            $collection = new ArrayCollection($data);

            return $this->paginate($collection, $resourceClass, $operationName);
        }

        throw new ResourceClassNotSupportedException();
    }

}
