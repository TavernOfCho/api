<?php

namespace App\DataProvider\BattleNet\Character;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataProvider\Traits\RealmFilterTrait;
use App\DataTransformer\CharacterTransformer;
use App\DataTransformer\GuildTransformer;
use App\DataTransformer\ItemsTransformer;
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
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Character
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
        ];
    }
}
