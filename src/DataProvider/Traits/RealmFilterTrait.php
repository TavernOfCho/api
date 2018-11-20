<?php

namespace App\DataProvider\Traits;

use Symfony\Component\HttpFoundation\Request;

trait RealmFilterTrait
{
    /**
     * Man made filters
     * @return array
     */
    public function getFilters()
    {
        return $this->getRequest()->query->all();
    }

    /**
     * @return null
     */
    public function checkFilters()
    {
        $filters = $this->getFilters();

        // Missing filter
        if (!isset($filters['realm'])) {
            return null;
        }

        return true;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getRealm()
    {
        if (null === $this->checkFilters()) {
            throw new \Exception("Realm filter is mandatory.");
        }

        return $this->getRequest()->query->get('realm');
    }

    /**
     * @return Request
     */
    abstract public function getRequest();
}
