<?php

namespace App\DataProvider\Traits;

use Symfony\Component\HttpFoundation\Request;

trait RealmFilterTrait
{
    /**
     * @return string
     * @throws \Exception
     */
    public function getRealm()
    {
        $realm = $this->getRequest()->attributes->get('realm', $this->getRequest()->query->get('realm'));

        if (null === $realm) {
            throw new \Exception("Realm filter is mandatory.");
        }

        return $realm;
    }

    /**
     * @return Request
     */
    abstract public function getRequest();
}
