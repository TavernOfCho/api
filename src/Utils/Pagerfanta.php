<?php

namespace App\Utils;

use ApiPlatform\Core\DataProvider\PaginatorInterface;
use Pagerfanta\Pagerfanta as BasePagerfanta;

/**
 * Extends the basic Pagerfanta with the ApiPlatform PaginatorInterface to get the hydra:view parameter in ld+json
 * Class Pagerfanta
 */
class Pagerfanta extends BasePagerfanta implements PaginatorInterface
{
    /**
     * Gets the current page number
     *
     * @return float
     */
    public function getCurrentPage(): float {
        return parent::getCurrentPage();
    }

    /**
     * Gets the last page
     *
     * @return float
     */
    public function getLastPage(): float {
        return parent::getNbPages();
    }

    /**
     * Gets the number of items by page
     *
     * @return float
     */
    public function getItemsPerPage(): float {
        return parent::getMaxPerPage();
    }

    /**
     * Gets the number of items in the whole collection
     *
     * @return float
     */
    public function getTotalItems(): float {
        return parent::getNbResults();
    }
}
