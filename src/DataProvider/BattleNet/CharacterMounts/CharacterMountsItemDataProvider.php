<?php

namespace App\DataProvider\BattleNet\CharacterMounts;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataProvider\Traits\RealmFilterTrait;
use App\DataTransformer\CharacterMountsTransformer;
use App\Models\CharacterMounts;

/**
 * Class MountItemDataProvider
 * @property CharacterMountsTransformer $transformer
 */
class CharacterMountsItemDataProvider extends AbstractBattleNetDataProvider implements ItemDataProviderInterface
{
    use RealmFilterTrait;

    public $model = CharacterMounts::class;

    /**
     * Retrieves an item.
     *
     * @param string $resourceClass
     * @param array|int|string $id
     * @param string|null $operationName
     * @param array $context
     * @return CharacterMounts
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if ($operationName === 'character_mounts') {
            $realm = $this->getRealm();

            $character = $this->battleNetSDK->getCharacter($id, $realm, 'mounts');
            $character['mounts']['name'] = $character['name'];

            return $this->transformer->transformItem($character['mounts']);
        }

        throw new ResourceClassNotSupportedException();
    }
}

