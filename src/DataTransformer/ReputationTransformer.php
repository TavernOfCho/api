<?php

namespace App\DataTransformer;

use App\Models\Reputation;

class ReputationTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Reputation
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, new Reputation());
    }

    /**
     * @param $data
     * @return array
     */
    public function transformCollection($data)
    {
        $data = $data['reputation'] ?? $data;
        $data = array_map(function ($data) {
            return $this->transformItem($data);
        }, $data);

        return $data;
    }
}
