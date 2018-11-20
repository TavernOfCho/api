<?php

namespace App\DataProvider\BattleNet\Feed;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataProvider\Traits\RealmFilterTrait;
use App\DataTransformer\FeedTransformer;
use App\Entity\Feed;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class FeedCollectionDataProvider
 * @property FeedTransformer $transformer
 */
class FeedCollectionDataProvider extends AbstractBattleNetDataProvider implements CollectionDataProviderInterface
{
    use RealmFilterTrait;

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Feed::class === $resourceClass;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @return array|mixed
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if ($operationName === 'character_feeds') {
            $realm = $this->getRealm();

            $character = $this->getRequest()->attributes->get('character');
            $character = $this->battleNetSDK->getCharacter($character, $realm, 'feed');

            $elements = $this->transformer->transformCollection($character);

            $collection = new ArrayCollection($elements);

            return $this->paginate($collection, $resourceClass, $operationName);
        }

        throw new ResourceClassNotSupportedException();
    }
}
