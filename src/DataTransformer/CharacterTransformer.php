<?php

namespace App\DataTransformer;

use App\Models\Character;

class CharacterTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Character
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, new Character());
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
