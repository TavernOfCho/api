<?php

namespace App\DataTransformer;

use App\Models\CharacterMounts;

class CharacterMountsTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return CharacterMounts
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, new CharacterMounts());
    }

    public function transformCollection($data)
    {
        $data = array_map(function ($data) {
            return $this->transformItem($data);
        }, $data);

        return $data;
    }
}
