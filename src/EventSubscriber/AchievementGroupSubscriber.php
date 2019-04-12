<?php


namespace App\EventSubscriber;

use App\DataTransformer\AchievementTransformer;
use App\Entity\AchievementGroup;
use App\Utils\BattleNetSDK;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class AchievementGroupSubscriber implements EventSubscriber
{
    /**
     * @var BattleNetSDK $battleNetSDK
     */
    private $battleNetSDK;

    /**
     * @var AchievementTransformer $transformer
     */
    private $transformer;

    /**
     * AchievementGroupSubscriber constructor.
     * @param BattleNetSDK $battleNetSDK
     * @param AchievementTransformer $transformer
     */
    public function __construct(BattleNetSDK $battleNetSDK, AchievementTransformer $transformer)
    {
        $this->battleNetSDK = $battleNetSDK;
        $this->transformer = $transformer;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            Events::postLoad,
        ];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        /** @var AchievementGroup $achievementGroup */
        $achievementGroup = $args->getObject();
        $achievementsDetails = array_map(function ($achievement) {
            return $this->transformer->transformItem($this->battleNetSDK->getAchievement($achievement));
        }, $achievementGroup->getAchievements());

        $achievementGroup->setAchievementsDetails($achievementsDetails);
    }
}