<?php

namespace App\DataFixtures\Processor;

use App\Entity\User;
use Fidry\AliceDataFixtures\ProcessorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserProcessor implements ProcessorInterface
{
    /** @var UserPasswordEncoderInterface $passwordEncoder */
    private $passwordEncoder;

    /**
     * EncodedPasswordProvider constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param string $fixtureId
     * @param User $object
     */
    public function preProcess(string $fixtureId, $object): void
    {
        if (!$object instanceof User) {
            return;
        }

        $encoded = $this->passwordEncoder->encodePassword($object, $object->getPlainPassword());
        $object->setPassword($encoded);
    }

    public function postProcess(string $fixtureId, $object): void
    {
    }
}
