<?php

namespace App\DataTransformer;

use App\Entity\Realm;

class RealmTransformer extends AbstractTransformer
{
    /**
     * @param $data
     * @return Realm
     */
    public function transformItem($data)
    {
        $realm = new Realm();

        foreach ($data as $key => $item) {
            if ($this->propertyAccessor->isReadable($realm, $key)) {
                $this->propertyAccessor->setValue($realm, $key, $item);
            }
        }

        return $realm;
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
