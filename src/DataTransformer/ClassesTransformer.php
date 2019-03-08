<?php

namespace App\DataTransformer;

use App\Models\Classes;

class ClassesTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Classes
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, new Classes());
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
