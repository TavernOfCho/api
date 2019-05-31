<?php

namespace App\DataTransformer;

use App\Models\Mounts;

class MountsTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Mounts
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, new Mounts());
    }

    public function transformCollection($data)
    {
        $data = array_map(function ($data) {
            return $this->transformItem($data);
        }, $data);

        return $data;
    }
}
