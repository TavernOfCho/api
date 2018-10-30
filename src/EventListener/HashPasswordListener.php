<?php
namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

/**
 * Class HashPasswordListener
 */
class HashPasswordListener implements EventSubscriber
{
    /** @var UserPasswordEncoder $passwordEncoder */
    private $passwordEncoder;

    /**
     * HashPasswordListener constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @return array|string[]
     */
    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate'];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        if (null === $entity = $this->getUser($args)) {
            return;
        }

        $this->encodePassword($entity);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        if (null === $entity = $this->getUser($args)) {
            return;
        }

        $this->encodePassword($entity);
        // necessary to force the update to see the change
        $manager = $args->getEntityManager();
        $meta = $manager->getClassMetadata(get_class($entity));
        $manager->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }

    /**
     * @param User $entity
     */
    private function encodePassword(User $entity)
    {
        if (!$entity->getPlainPassword()) {
            return;
        }

        $encoded = $this->passwordEncoder->encodePassword($entity, $entity->getPlainPassword());
        $entity->setPassword($encoded);
    }

    /**
     * @param LifecycleEventArgs $args
     * @return null|object|User
     */
    private function getUser(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        return $entity instanceof User ? $entity : null;
    }
}
