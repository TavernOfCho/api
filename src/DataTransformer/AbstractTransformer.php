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

}
