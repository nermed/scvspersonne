<?php

namespace App\Repository;

use App\Entity\AutreExperience;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AutreExperience|null find($id, $lockMode = null, $lockVersion = null)
 * @method AutreExperience|null findOneBy(array $criteria, array $orderBy = null)
 * @method AutreExperience[]    findAll()
 * @method AutreExperience[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutreExperienceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AutreExperience::class);
    }

    // /**
    //  * @return AutreExperience[] Returns an array of AutreExperience objects
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
    public function findOneBySomeField($value): ?AutreExperience
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
