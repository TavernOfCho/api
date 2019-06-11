<?php

namespace App\DataTransformer;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

abstract class AbstractTransformer implements TransformerInterface
{
    /** @var PropertyAccessorInterface $propertyAccessor */
    protected $propertyAccessor;

    /**
     * RealmTransformer constructor.
     */
    public function __construct()
    {
        $this->propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()->getPropertyAccessor();
    }

    /**
     * @return PropertyAccessorInterface
     */
    public function getPropertyAccessor(): PropertyAccessorInterface
    {
        return $this->propertyAccessor;
    }

    /**
     * @param $data
     * @param $object
     * @return mixed
     */
    protected function fillProperties($data, $object)
    {
        return $this->fillPropertiesClosure($data, $object, function ($item) {
            return $item;
        });
    }

    /**
     * @param $data
     * @param $object
     * @param \Closure $callback
     * @return mixed
     */
    protected function fillPropertiesClosure($data, $object, \Closure $callback)
    {
        foreach ($data as $key => $item) {
            if ($this->propertyAccessor->isReadable($object, $key)) {
                $item = $callback($item, $key, $object);
                $this->propertyAccessor->setValue($object, $key, $item);
            }
        }

        return $object;
    }


}
