<?php

namespace App\Controller\Api;

class DefaultAction
{
    public function __invoke($data)
    {
        return $data;
    }
}
