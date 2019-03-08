<?php

namespace App\DataTransformer;

use App\Models\Realm;

class RealmTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Realm
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, new Realm());
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
