<?php

namespace App\DataProvider\BattleNet\Achievement;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataTransformer\AchievementTransformer;
use App\Entity\Achievement;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class AchievementCollectionDataProvider
 * @property AchievementTransformer $transformer
 */
class AchievementCollectionDataProvider extends AbstractBattleNetDataProvider implements CollectionDataProviderInterface
{
    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Achievement::class === $resourceClass;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @return array|mixed
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if ($operationName === 'character_achievements') {
            if (null === $this->checkFilters()) {
                return null;
            }

            $character = $this->getRequest()->attributes->get('character');
            $realm = $this->getRequest()->query->get('realm');
            $character = $this->battleNetSDK->getCharacter($character, $realm, 'achievements');

            $achievements = array_combine(
                $character['achievements']['achievementsCompletedTimestamp'],
                $character['achievements']['achievementsCompleted']
            );

            array_walk($achievements, function (&$achievement, $timestamp) {
                $achievement = $this->battleNetSDK->getAchievement($achievement);
                $achievement = $this->transformer->transformItem($achievement);
                $achievement->setCompletedAt($this->battleNetSDK->formatTimestamp($timestamp));
            });

            $collection = new ArrayCollection($achievements);

            return $this->paginate($collection, $resourceClass, $operationName);
        }

        throw new ResourceClassNotSupportedException();
    }

    /**
     * Man made filters
     * @return array
     */
    public function getFilters()
    {
        return $this->getRequest()->query->all();
    }

    /**
     * @return null
     */
    public function checkFilters()
    {
        $filters = $this->getFilters();

        // Missing filter
        if (!isset($filters['realm'])) {
            return null;
        }

        return true;
    }
}
