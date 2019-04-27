<?php

namespace App\DataTransformer;

use App\Models\Pets;

class PetsTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Pets
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, new Pets());
    }

    public function transformCollection($data)
    {
        $data = array_map(function ($data) {
            return $this->transformItem($data);
        }, $data);

        return $data;
    }
}
