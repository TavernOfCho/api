<?php

namespace App\DataProvider\BattleNet\Achievement;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataProvider\Traits\RealmFilterTrait;
use App\DataTransformer\AchievementTransformer;
use App\Entity\Achievement;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class AchievementCollectionDataProvider
 * @property AchievementTransformer $transformer
 */
class AchievementCollectionDataProvider extends AbstractBattleNetDataProvider implements CollectionDataProviderInterface
{
    use RealmFilterTrait;

    public $model = Achievement::class;

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @return array|mixed
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if ($operationName === 'character_completed_achievements') {
            $realm = $this->getRealm();

            $character = $this->getRequest()->attributes->get('character');
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

        if ($operationName === 'character_achievements') {
            $realm = $this->getRealm();

            $character = $this->getRequest()->attributes->get('character');
            $character = $this->battleNetSDK->getCharacter($character, $realm);
            $content = $this->battleNetSDK->getAchievements($character['faction']);
            $content = $content['achievements'];

            $data = [];

            foreach ($content as $item) {
                $achievements = $item['achievements'] ?? [];

                $categoriesAchievements = array_column($item['categories'] ?? [], 'achievements');
                foreach ($categoriesAchievements as $categogiesAchievement) {
                    $achievements = array_merge($achievements, $categogiesAchievement);
                }

                $achievements = array_filter($achievements, function (array $achievement) use ($character) {
                    return $achievement['factionId'] === $character['faction'];
                });

                $achievements = array_map(function ($achievement) use ($item) {
                    $achievement['category'] = $item['name'];

                    return $achievement;
                }, $achievements);


                $data = array_merge($data, $achievements);
            }

            $collection = new ArrayCollection($data);

            return $this->paginate($collection, $resourceClass, $operationName);
        }

        throw new ResourceClassNotSupportedException();
    }
}
