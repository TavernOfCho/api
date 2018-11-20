<?php

namespace App\DataProvider\BattleNet\Character;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\BattleNet\AbstractBattleNetDataProvider;
use App\DataTransformer\CharacterTransformer;
use App\Entity\Character;

/**
 * Class CharacterItemDataProvider
 * @author François MATHIEU <francois.mathieu@livexp.fr>
 * @property CharacterTransformer $transformer
 */
class CharacterItemDataProvider extends AbstractBattleNetDataProvider implements ItemDataProviderInterface
{

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Character::class === $resourceClass;
    }

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
            if (null === $this->checkFilters()) {
                return null;
            }

            $realm = $this->getRequest()->query->get('realm');

            return $this->transformer->transformItem($this->battleNetSDK->getCharacter($id, $realm));
        }

        throw new ResourceClassNotSupportedException();
    }

    /**
     * Man made filters
     * @return array
     */
    public function getFilters()
    {
        return $this->getRequest()->query->all();
    }

    /**
     * @return null
     */
    public function checkFilters()
    {
        $filters = $this->getFilters();

        // Missing filter
        if (!isset($filters['realm'])) {
            return null;
        }

        return true;
    }

}
