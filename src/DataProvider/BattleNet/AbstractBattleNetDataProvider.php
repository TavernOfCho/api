<?php

namespace App\DataProvider\BattleNet;

use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use App\DataTransformer\TransformerInterface;
use App\Utils\BattleNetSDK;
use App\Utils\Pagerfanta;
use Doctrine\Common\Collections\ArrayCollection;
use Pagerfanta\Adapter\DoctrineCollectionAdapter;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

abstract class AbstractBattleNetDataProvider implements RestrictedDataProviderInterface, ServiceSubscriberInterface
{
    /** @var BattleNetSDK $battleNetSDK */
    protected $battleNetSDK;

    /** @var TransformerInterface $transformer */
    protected $transformer;

    /** @var RequestStack $requestStack */
    protected $requestStack;

    /** @var ResourceMetadataFactoryInterface $resourceMetadataFactory */
    protected $resourceMetadataFactory;

    /** @var ContainerInterface $container */
    protected $container;

    public $model;

    /**
     * BattleNetCollectionDataProvider constructor.
     * @param BattleNetSDK $battleNetSDK
     * @param RequestStack $requestStack
     * @param ResourceMetadataFactoryInterface $resourceMetadataFactory
     * @param ContainerInterface $container
     */
    public function __construct(BattleNetSDK $battleNetSDK,
                                RequestStack $requestStack,
                                ResourceMetadataFactoryInterface $resourceMetadataFactory,
                                ContainerInterface $container)
    {
        $this->battleNetSDK = $battleNetSDK;
        $this->requestStack = $requestStack;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
        $this->container = $container;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $this->model === $resourceClass;
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
        $itemsPerPage = $this->getItemPerPage($resourceClass, $operationName);

        $adapter = new DoctrineCollectionAdapter($collection);
        $pagerfanta = new Pagerfanta($adapter);

        $pagerfanta->setMaxPerPage($itemsPerPage);
        $pagerfanta->setCurrentPage($this->getPage());

        return $pagerfanta;
    }

    /**
     * @param string $resourceClass
     * @param string $operationName
     * @return int|null
     */
    protected function getItemPerPage(string $resourceClass, string $operationName)
    {
        $resourceMetadata = $this->resourceMetadataFactory->create($resourceClass);

        return $resourceMetadata->getCollectionOperationAttribute($operationName, 'pagination_items_per_page', 30, true);
    }

    /**
     * @return int
     */
    protected function getPage()
    {
        return $this->getRequest()->query->getInt('page', 1);
    }

    /**
     * @return null|Request
     */
    protected function getRequest()
    {
        return $this->requestStack->getCurrentRequest();
    }

    /**
     * @return TransformerInterface
     */
    public function getTransformer(): TransformerInterface
    {
        return $this->transformer;
    }

    /**
     * @param TransformerInterface $transformer
     * @return AbstractBattleNetDataProvider
     */
    public function setTransformer(TransformerInterface $transformer): self
    {
        $this->transformer = $transformer;

        return $this;
    }

    public static function getSubscribedServices()
    {
        return [];
    }

}
