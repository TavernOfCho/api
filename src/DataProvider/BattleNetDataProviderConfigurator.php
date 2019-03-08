<?php

namespace App\DataProvider;

use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataTransformer\DefaultTransformer;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Symfony\Component\Finder\Finder;

class BattleNetDataProviderConfigurator implements ServiceSubscriberInterface
{
    /**
     * @var ContainerInterface $container
     */
    private $container;

    /**
     * BattleNetDataProviderConfigurator constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param AbstractBattleNetDataProvider $battleNetDataProvider
     */
    public function configure(AbstractBattleNetDataProvider $battleNetDataProvider)
    {
        $class = $battleNetDataProvider->model;

        $model = explode('\\', $class);
        $transformer = sprintf('App\DataTransformer\%sTransformer', end($model));

        $transformer = $this->container->has($transformer) ?
            $this->container->get($transformer) :
            new DefaultTransformer($class);

        call_user_func_array([$battleNetDataProvider, 'setTransformer'], [$transformer]);
    }

    /**
     * return all the DataTransformer class
     *
     * @return array The required service types, optionally keyed by service names
     */
    public static function getSubscribedServices()
    {
        $ignoredTransformers = [
            'App\DataTransformer\AbstractTransformer',
            'App\DataTransformer\DefaultTransformer',
            'App\DataTransformer\TransformerInterface'
        ];

        $finder = new Finder();
        $finder->files()->in(__DIR__ . "/../DataTransformer");

        $files = [];
        foreach ($finder->files()->getIterator() as $fileInfo) {
            $file = sprintf("App\DataTransformer\%s", str_replace(".php", '', $fileInfo->getFilename()));
            if (!in_array($file, $ignoredTransformers)) {
                $files[] = $file;
            }
        }

        return $files;
    }
}
