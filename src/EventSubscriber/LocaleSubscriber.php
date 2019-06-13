<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class LocaleSubscriber implements EventSubscriberInterface
{
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $locale = $request->query->get('locale');

        $locales = ['en_GB', 'es_ES', 'fr_FR', 'ru_RU', 'de_DE', 'pt_PT', 'it_IT'];

        if (null !== $locale && in_array($locale, $locales)) {
            $request->attributes->set('_locale', $locale);
            $request->setLocale($locale);
        }
    }

    /**
     * The priority is defined to 17 to be called before the LocaleListener
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'kernel.request' => ['onKernelRequest', 17],
        ];
    }
}
