<?php

namespace App\DataProvider\BattleNet\Character;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataProvider\Traits\RealmFilterTrait;
use App\DataTransformer\CharacterTransformer;
use App\DataTransformer\GuildTransformer;
use App\DataTransformer\ItemsTransformer;
use App\DataTransformer\MountsTransformer;
use App\DataTransformer\PetsTransformer;
use App\DataTransformer\StatsTransformer;
use App\Models\Character;

/**
 * Class CharacterItemDataProvider
 * @property CharacterTransformer $transformer
 */
class CharacterItemDataProvider extends AbstractBattleNetDataProvider implements ItemDataProviderInterface
{
    use RealmFilterTrait;

    public $model = Character::class;

    /**
     * Retrieves an item.
     *
     * @param string $resourceClass
     * @param array|int|string $id
     * @param string|null $operationName
     * @param array $context
     * @return Character
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if ($operationName === 'get') {
            $realm = $this->getRealm();

            return $this->transformer->transformItem($this->battleNetSDK->getCharacter($id, $realm));
        }

        if ($operationName === 'character_guild') {
            $realm = $this->getRealm();
            $guildTransformer = $this->container->get(GuildTransformer::class);

            return $guildTransformer->transformItem($this->battleNetSDK->getCharacter($id, $realm, 'guild'));
        }

        if ($operationName === 'character_items') {
            $realm = $this->getRealm();
            $itemsTransformer = $this->container->get(ItemsTransformer::class);

            $character = $this->battleNetSDK->getCharacter($id, $realm, 'items');
            $character['items']['name'] = $character['name'];

            return $itemsTransformer->transformItem($character['items']);
        }

        if ($operationName === 'character_stats') {
            $realm = $this->getRealm();
            $statsTransformer = $this->container->get(StatsTransformer::class);

            $character = $this->battleNetSDK->getCharacter($id, $realm, 'stats');
            $character['stats']['name'] = $character['name'];

            return $statsTransformer->transformItem($character['stats']);
        }

        if ($operationName === 'character_pets') {
            $realm = $this->getRealm();
            $petsTransformer = $this->container->get(PetsTransformer::class);

            $character = $this->battleNetSDK->getCharacter($id, $realm, 'pets');
            $character['pets']['name'] = $character['name'];

            return $petsTransformer->transformItem($character['pets']);
        }

        if ($operationName === 'character_mounts') {
            $realm = $this->getRealm();
            $mountsTransformer = $this->container->get(MountsTransformer::class);

            $character = $this->battleNetSDK->getCharacter($id, $realm, 'mounts');
            $character['mounts']['name'] = $character['name'];

            return $mountsTransformer->transformItem($character['mounts']);
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
            'App\DataTransformer\GuildTransformer',
            'App\DataTransformer\StatsTransformer',
            'App\DataTransformer\PetsTransformer',
            'App\DataTransformer\MountsTransformer',
        ];
    }
}
