<?php

namespace App\DataTransformer;

use App\Entity\Realm;
use Symfony\Component\PropertyAccess\PropertyAccess;

class RealmTransformer
{
    /**
     * @param $data
     * @return Realm
     */
    public function transform($data)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()->getPropertyAccessor();
        $realm = new Realm();

        foreach ($data as $key => $item) {
            if ($propertyAccessor->isReadable($realm, $key)) {
                $propertyAccessor->setValue($realm, $key, $item);
            }
        }

        return $realm;
    }
}
