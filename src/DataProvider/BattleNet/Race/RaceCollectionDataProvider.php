<?php

namespace App\DataProvider\BattleNet\Race;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataTransformer\RaceTransformer;
use App\Models\Race;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class RaceCollectionDataProvider
 * @property RaceTransformer $transformer
 */
class RaceCollectionDataProvider extends AbstractBattleNetDataProvider implements CollectionDataProviderInterface
{
    public $model= Race::class;

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @return array|mixed
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if ($operationName === 'get') {
            $races = $this->battleNetSDK->getCharacterRaces();
            $races = $races['races'];

            $data = $this->transformer->transformCollection($races);
            $collection = new ArrayCollection($data);

            return $this->paginate($collection, $resourceClass, $operationName);
        }

        throw new ResourceClassNotSupportedException();
    }

}
