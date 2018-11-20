<?php

namespace App\DataTransformer;

use App\DataProvider\BattleNet\Character\CharacterItemDataProvider;
use App\Entity\Character;
use App\Utils\BattleNetSDK;
use Doctrine\Common\Collections\ArrayCollection;

class CharacterTransformer extends AbstractTransformer
{
    /** @var AchivementTransformer $achivementTransformer */
    private $achivementTransformer;

    /** @var BattleNetSDK $battleNetSDK */
    private $battleNetSDK;

    const TRANSFORMED_FIELDS = ['achievements'];

    /**
     * CharacterTransformer constructor.
     * @param BattleNetSDK $battleNetSDK
     * @param AchivementTransformer $achivementTransformer
     */
    public function __construct(BattleNetSDK $battleNetSDK, AchivementTransformer $achivementTransformer)
    {
        parent::__construct();
        $this->achivementTransformer = $achivementTransformer;
        $this->battleNetSDK = $battleNetSDK;
    }

    /**
     * @param $data
     * @param int|null $page
     * @param int|null $maxPerPage
     * @return Character
     */
    public function transformItem($data, int $page = null, int $maxPerPage = null)
    {
        $character = new Character();

        foreach ($data as $key => $item) {
            if ($this->propertyAccessor->isReadable($character, $key)) {
                if (in_array($key, CharacterItemDataProvider::ALLOWED_FIELDS)) {
                    if (null === $item = $this->transformFields($key, $item, $page, $maxPerPage)) {
                        continue;
                    }
                }

                $this->propertyAccessor->setValue($character, $key, $item);
            }
        }

        return $character;
    }

    /**
     * @param $field
     * @param $data
     * @param int|null $page
     * @param int|null $maxPerPage
     * @return ArrayCollection|null
     */
    private function transformFields($field, $data, int $page = null, int $maxPerPage = null)
    {
        $final = null;
        if ($field === 'achievements') {
            $achievements = $data['achievementsCompleted'];

            $final = array_map(function ($achivement) {
                $achivement = $this->battleNetSDK->getAchivement($achivement);
                $achivement = $this->achivementTransformer->transformItem($achivement);

                return $achivement;
            }, $achievements);

            $final = new ArrayCollection($final);
        }

        if ($final instanceof ArrayCollection && $final->count() > 30) {
            $slice = $final->slice($page * $maxPerPage, $maxPerPage);
            $final = new ArrayCollection($slice);
        }

        return $final;
    }

    /**
     * @param $data
     * @return null
     */
    public function transformCollection($data)
    {
        return null; // No Collection method for the Character
    }
}
