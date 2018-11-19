<?php

namespace App\DataTransformer;

use App\Entity\Realm;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class RealmTransformer
{
    /** @var PropertyAccessorInterface $propertyAccessor */
    private $propertyAccessor;

    /**
     * RealmTransformer constructor.
     */
    public function __construct()
    {
        $this->propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()->getPropertyAccessor();
    }

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

    public function transformCollection($data)
    {
        $data = array_map(function ($data) {
            return $this->transformItem($data);
        }, $data);

        return $data;
    }
}
