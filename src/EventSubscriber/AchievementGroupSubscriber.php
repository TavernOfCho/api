<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\DataTransformer\AchievementTransformer;
use App\Entity\AchievementGroup;
use App\Utils\BattleNetSDK;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class AchievementGroupSubscriber implements EventSubscriberInterface
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
     * @param ViewEvent $event
     */
    public function onKernelView(ViewEvent $event)
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($entity instanceof AchievementGroup && $method === Request::METHOD_GET) {
            $achievementsDetails = array_map(function ($achievement) {
                try {
                    return $this->transformer->transformItem($this->battleNetSDK->getAchievement($achievement));
                } catch (ClientException $e) {
                    return null;
                }
            }, $entity->getAchievements());

            $achievementsDetails = array_filter($achievementsDetails);
            $entity->setAchievementsDetails($achievementsDetails);
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'kernel.view' => ['onKernelView', EventPriorities::PRE_SERIALIZE],
        ];
    }
}
