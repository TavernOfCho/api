<?php

namespace App\DataTransformer;

use App\Models\Mount;

class MountTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Mount
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, new Mount());
    }

    public function transformCollection($data)
    {
        $data = array_map(function ($data) {
            return $this->transformItem($data);
        }, $data);

        return $data;
    }
}
