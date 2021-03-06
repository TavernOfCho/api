<?php

namespace App\DataTransformer;

use App\Models\Achievement;

class AchievementTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Achievement
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, new Achievement());
    }

    public function transformCollection($data)
    {
        $data = array_map(function ($data) {
            return $this->transformItem($data);
        }, $data);

        return $data;
    }
}
