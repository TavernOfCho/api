<?php

namespace App\DataProvider\BattleNet\Items;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataProvider\Traits\RealmFilterTrait;
use App\DataTransformer\ItemsTransformer;
use App\Models\Items;

/**
 * Class ItemsItemDataProvider
 * @property ItemsTransformer $transformer
 */
class ItemsItemDataProvider extends AbstractBattleNetDataProvider implements ItemDataProviderInterface
{
    use RealmFilterTrait;

    public $model = Items::class;

    /**
     * Retrieves an item.
     *
     * @param string $resourceClass
     * @param array|int|string $id
     * @param string|null $operationName
     * @param array $context
     * @return Items
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if ($operationName === 'character_items') {
            $realm = $this->getRealm();

            $character = $this->battleNetSDK->getCharacter($id, $realm, 'items');
            $character['items']['name'] = $character['name'];

            return $this->transformer->transformItem($character['items']);
        }

        throw new ResourceClassNotSupportedException();
    }

    /**
     * @return array
     */
    public static function getSubscribedServices()
    {
        return [
            'App\DataTransformer\ItemsTransformer',
        ];
    }
}
