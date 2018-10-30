<?php
namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Entity\User;

class UserSecurityAction
{
    /**
     * @param User[] $data
     * @return NotFoundHttpException|AccessDeniedException|User[]
     */
    public function __invoke($data)
    {
        return $data;
    }

}
