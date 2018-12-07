<?php

namespace App\DataTransformer;

use App\Entity\Race;

class RaceTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Race
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, new Race());
    }

    /**
     * @param $data
     * @return array
     */
    public function transformCollection($data)
    {
        $data = array_map(function ($data) {
            return $this->transformItem($data);
        }, $data);

        return $data;
    }
}
