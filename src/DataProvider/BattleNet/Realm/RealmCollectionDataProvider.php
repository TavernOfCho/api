<?php

namespace App\DataProvider\BattleNet\Realm;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use App\DataTransformer\RealmTransformer;
use App\Entity\Realm;
use App\Utils\BattleNetSDK;
use App\Utils\Pagerfanta;
use Doctrine\Common\Collections\ArrayCollection;
use Pagerfanta\Adapter\DoctrineCollectionAdapter;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class RealmCollectionDataProvider
 */
class RealmCollectionDataProvider extends RealmDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var ResourceMetadataFactoryInterface $resourceMetadataFactory */
    private $resourceMetadataFactory;

    /**
     * RealmCollectionDataProvider constructor.
     * @param BattleNetSDK $battleNetSDK
     * @param RealmTransformer $transformer
     * @param RequestStack $requestStack
     * @param ResourceMetadataFactoryInterface $resourceMetadataFactory
     */
    public function __construct(BattleNetSDK $battleNetSDK, RealmTransformer $transformer, RequestStack $requestStack, ResourceMetadataFactoryInterface $resourceMetadataFactory)
    {
        parent::__construct($battleNetSDK, $transformer, $requestStack);
        $this->resourceMetadataFactory = $resourceMetadataFactory;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Realm::class === $resourceClass;
    }

    /**
     * @see https://github.com/api-platform/api-platform/issues/183 for elasticsearch method
     * @param string $resourceClass
     * @param string|null $operationName
     * @return array|mixed
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if ($operationName === 'get') {
            $realms = $this->battleNetSDK->getRealms();
            $realms = array_map(function ($realm) {
                return $this->battleNetSDK->getRealm($realm['slug']);
            }, $realms['realms']);

            $data = $this->transformer->transformCollection($realms);
            $collection = new ArrayCollection($data);

            $resourceMetadata = $this->resourceMetadataFactory->create($resourceClass);
            $itemsPerPage = $resourceMetadata
                ->getCollectionOperationAttribute($operationName, 'pagination_items_per_page', 30, true);

            $request = $this->requestStack->getCurrentRequest();

            $adapter = new DoctrineCollectionAdapter($collection);
            $pagerfanta = new Pagerfanta($adapter);

            $pagerfanta->setMaxPerPage($itemsPerPage);
            $pagerfanta->setCurrentPage($request->query->getInt('page', 1));

            return $pagerfanta;
        }

        throw new ResourceClassNotSupportedException();
    }

}
