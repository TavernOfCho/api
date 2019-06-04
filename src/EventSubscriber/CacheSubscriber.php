<?php

namespace App\EventSubscriber;

use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class CacheSubscriber implements EventSubscriberInterface
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cacheManager;

    public function __construct(CacheItemPoolInterface $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        if ($event->getRequest()->headers->get('Custom-Cache-Control') === "clear-battle-net") {
            $session = $event->getRequest()->getSession();

            // Remove the BattleNet API SDK from the session
            $session->remove('access_token');

            // Clear the cache.battle_net cache pool
            $this->cacheManager->clear();
        }
    }

    public static function getSubscribedEvents()
    {
        return [
           'kernel.request' => 'onKernelRequest',
        ];
    }
}
