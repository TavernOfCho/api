<?php

namespace App\DataProvider\BattleNet\Pets;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataProvider\Traits\RealmFilterTrait;
use App\DataTransformer\PetsTransformer;
use App\Models\Pets;

/**
 * Class PetsItemDataProvider
 * @property PetsTransformer $transformer
 */
class PetsItemDataProvider extends AbstractBattleNetDataProvider implements ItemDataProviderInterface
{
    use RealmFilterTrait;

    public $model = Pets::class;

    /**
     * Retrieves an item.
     *
     * @param string $resourceClass
     * @param array|int|string $id
     * @param string|null $operationName
     * @param array $context
     * @return Pets
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if ($operationName === 'character_pets') {
            $realm = $this->getRealm();

            $character = $this->battleNetSDK->getCharacter($id, $realm, 'pets');
            $character['pets']['name'] = $character['name'];

            return $this->transformer->transformItem($character['pets']);
        }

        throw new ResourceClassNotSupportedException();
    }
}
