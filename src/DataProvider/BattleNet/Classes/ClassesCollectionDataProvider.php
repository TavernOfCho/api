<?php

namespace App\DataProvider\BattleNet\Classes;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\Entity\Classes;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class RealmCollectionDataProvider
 */
class ClassesCollectionDataProvider extends AbstractBattleNetDataProvider implements CollectionDataProviderInterface
{
    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Classes::class === $resourceClass;
    }

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
