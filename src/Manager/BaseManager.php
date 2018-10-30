<?php

namespace App\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class BaseManager
 * @package App\Manager
 */
abstract class BaseManager
{
    /**
     * @var ObjectManager|EntityManager $manager
     */
    private $manager;

    /**
     * @var string $class
     */
    private $class;

    /**
     * BaseManager constructor.
     * @param ObjectManager $manager
     * @param string $class
     */
    public function __construct(ObjectManager $manager, string $class)
    {
        $this->manager = $manager;
        $this->class = $class;
    }

    /**
     * @return ObjectManager|EntityManager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @return ObjectRepository|EntityRepository
     */
    public function getRepository()
    {
        return $this->manager->getRepository($this->class);
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param object $entity
     * @return BaseManager
     */
    public function persistAndFlush($entity): BaseManager
    {
        $this->getManager()->persist($entity);
        $this->getManager()->flush();

        return $this;
    }

    /**
     * @param object $entity
     * @return BaseManager
     */
    public function removeEntity($entity): BaseManager
    {
        $this->getManager()->remove($entity);
        $this->getManager()->flush();

        return $this;
    }

    /**
     * @return object
     */
    public function newClass()
    {
        return new $this->class;
    }
}