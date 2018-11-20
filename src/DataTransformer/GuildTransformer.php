<?php

namespace App\DataTransformer;

use App\Entity\Guild;

class GuildTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Guild
     */
    public function transformItem($data)
    {
        $data = $data['guild'] ?? $data;

        return $this->fillProperties($data, new Guild());
    }

    /**
     * @param $data
     * @return array
     */
    public function transformCollection($data)
    {
        return null; // No Collection method for the Character
    }
}
