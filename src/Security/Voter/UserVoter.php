<?php

namespace App\Security\Voter;

use App\Entity\Airport;
use App\Entity\User;
use App\Repository\AirportRepository;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    const USER_UPDATE = 'user_update';
    const USER_DELETE = 'user_delete';

    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, [self::USER_UPDATE, self::USER_DELETE])
            && $subject instanceof User;
    }

    /**
     * @param string $attribute
     * @param User $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof User) {
            return false;
        }

        switch ($attribute) {
            case self::USER_UPDATE:
                return $subject === $user;
                break;
            case self::USER_DELETE:
                return $subject === $user;
                break;
        }

        return false;
    }
}
