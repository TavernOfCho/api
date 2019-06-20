<?php

namespace App\DataProvider\BattleNet\Reputation;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataProvider\Traits\RealmFilterTrait;
use App\DataTransformer\ReputationTransformer;
use App\Models\Reputation;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ReputationCollectionDataProvider
 * @property ReputationTransformer $transformer
 */
class ReputationCollectionDataProvider extends AbstractBattleNetDataProvider implements CollectionDataProviderInterface
{
    use RealmFilterTrait;

    public $model = Reputation::class;

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @return array|mixed
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if ($operationName == 'character_reputations') {
            $realm = $this->getRealm();
            $character = $this->getRequest()->attributes->get('id');
            $character = $this->battleNetSDK->getCharacter($character, $realm, 'reputation');
            $elements = $this->transformer->transformCollection($character);

            $collection = new ArrayCollection($elements);

            return $this->paginate($collection, $resourceClass, $operationName);
        }

        throw new ResourceClassNotSupportedException();
    }
}
