<?php

namespace App\DataProvider\BattleNet\Guild;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataProvider\Traits\RealmFilterTrait;
use App\DataTransformer\GuildTransformer;
use App\Models\Character;
use App\Models\Guild;

/**
 * Class GuildItemDataProvider
 * @property GuildTransformer $transformer
 */
class GuildItemDataProvider extends AbstractBattleNetDataProvider implements ItemDataProviderInterface
{
    use RealmFilterTrait;

    public $model = Guild::class;

    /**
     * Retrieves an item.
     *
     * @param string $resourceClass
     * @param array|int|string $id
     * @param string|null $operationName
     * @param array $context
     * @return Guild
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if ($operationName === 'character_guild') {
            $realm = $this->getRealm();

            return $this->transformer->transformItem($this->battleNetSDK->getCharacter($id, $realm, 'guild'));
        }

        throw new ResourceClassNotSupportedException();
    }

}
