<?php

namespace App\DataTransformer;

use App\Models\Stats;

class StatsTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Stats
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, new Stats());
    }

    public function transformCollection($data)
    {
        $data = array_map(function ($data) {
            return $this->transformItem($data);
        }, $data);

        return $data;
    }
}
