<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserSecurityItemDataProvider
 * @package App\DataProvider
 */
final class UserSecurityItemDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var ObjectManager $manager */
    private $manager;

    /** @var Request $request */
    private $request;

    /** @var UserPasswordEncoderInterface $encoder */
    private $encoder;

    /** @var string $api_key */
    private $api_key;

    /**
     * EvaluationManager constructor.
     * @param ObjectManager $manager
     * @param RequestStack $requestStack
     * @param UserPasswordEncoderInterface $encoder
     * @param string $api_key
     */
    public function __construct(ObjectManager $manager, RequestStack $requestStack, UserPasswordEncoderInterface $encoder, string $api_key)
    {
        $this->manager = $manager;
        $this->request = $requestStack->getCurrentRequest();
        $this->encoder = $encoder;
        $this->api_key = $api_key;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return User::class === $resourceClass;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @return array|object[]|\Traversable
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if (User::class != $resourceClass || $operationName != "user_security") {
            throw new ResourceClassNotSupportedException();
        }

        $filters = $this->getFilters();

        // Missing filter
        if (!isset($filters['api_key'], $filters['username'], $filters['password'])) {
            throw new ResourceClassNotSupportedException();
        }

        // Wrong API key
        if ($filters['api_key'] != $this->api_key) {
            return null;
        }

        $users = $this->manager->getRepository(User::class)->findBy(['username' => $filters['username']]);

        return array_filter($users, function (User $user) use($filters) {
            return $this->encoder->isPasswordValid($user, $filters['password']);
        });
    }

    /**
     * Man made filters
     * @return array
     */
    public function getFilters()
    {
        return $this->request->query->all();
    }

}
