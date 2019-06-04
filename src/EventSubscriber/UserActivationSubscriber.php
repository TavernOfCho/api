<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use App\Utils\Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class UserActivationSubscriber implements EventSubscriberInterface
{
    /** @var Mailer $mailer */
    private $mailer;

    /** @var string $websiteUrl */
    private $websiteUrl;

    /**
     * UserActivationSubscriber constructor.
     * @param Mailer $mailer
     * @param string $websiteUrl
     */
    public function __construct(Mailer $mailer, string $websiteUrl)
    {
        $this->mailer = $mailer;
        $this->websiteUrl = $websiteUrl;
    }

    public function onKernelView(ViewEvent $event)
    {
        /** @var User $entity */
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        $methods = [Request::METHOD_POST, Request::METHOD_PUT];
        if ($entity instanceof User && in_array($method, $methods) && null === $entity->getEnabledCode() && !$entity->getEnabled()) {
            $entity->setEnabledCode(uniqid())->setEnabledCodeDate(new \DateTime());
            $this->mailer->sendMail('Activez votre compte TavernOfCho', $entity->getEmail(), 'user_email_activation.html.twig', [
                'code' => $entity->getEnabledCode(),
                'domain' => $this->websiteUrl
            ]);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.view' => ['onKernelView', EventPriorities::PRE_WRITE]
        ];
    }
}
