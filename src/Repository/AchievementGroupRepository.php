<?php

namespace App\Repository;

use App\Entity\AchievementGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AchievementGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method AchievementGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method AchievementGroup[]    findAll()
 * @method AchievementGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AchievementGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AchievementGroup::class);
    }

    // /**
    //  * @return AchievementGroup[] Returns an array of AchievementGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AchievementGroup
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
