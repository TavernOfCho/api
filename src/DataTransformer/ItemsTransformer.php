<?php

namespace App\DataTransformer;

use App\Models\Items;

class ItemsTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Items
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, new Items());
    }

    public function transformCollection($data)
    {
        $data = array_map(function ($data) {
            return $this->transformItem($data);
        }, $data);

        return $data;
    }
}
