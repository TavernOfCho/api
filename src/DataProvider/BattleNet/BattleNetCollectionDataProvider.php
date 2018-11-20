<?php

namespace App\DataProvider\BattleNet;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use App\DataTransformer\TransformerInterface;
use App\Utils\BattleNetSDK;
use App\Utils\Pagerfanta;
use Doctrine\Common\Collections\ArrayCollection;
use Pagerfanta\Adapter\DoctrineCollectionAdapter;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class BattleNetCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var BattleNetSDK $battleNetSDK */
    protected $battleNetSDK;

    /** @var TransformerInterface $transformer */
    protected $transformer;

    /** @var RequestStack $requestStack */
    protected $requestStack;

    /** @var ResourceMetadataFactoryInterface $resourceMetadataFactory */
    protected $resourceMetadataFactory;

    /**
     * BattleNetCollectionDataProvider constructor.
     * @param BattleNetSDK $battleNetSDK
     * @param TransformerInterface $transformer
     * @param RequestStack $requestStack
     * @param ResourceMetadataFactoryInterface $resourceMetadataFactory
     */
    public function __construct(BattleNetSDK $battleNetSDK, TransformerInterface $transformer,
                                RequestStack $requestStack, ResourceMetadataFactoryInterface $resourceMetadataFactory)
    {
        $this->battleNetSDK = $battleNetSDK;
        $this->transformer = $transformer;
        $this->requestStack = $requestStack;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
    }

    /**
     * @see https://github.com/api-platform/api-platform/issues/183 for elasticsearch method
     * @param ArrayCollection $collection
     * @param string $resourceClass
     * @param string|null $operationName
     * @return Pagerfanta
     */
    protected function paginate(ArrayCollection $collection, string $resourceClass, string $operationName = null)
    {
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
}
