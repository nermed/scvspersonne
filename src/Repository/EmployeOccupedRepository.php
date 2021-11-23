<?php

namespace App\Repository;

use App\Entity\EmployeOccuped;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmployeOccuped|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeOccuped|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeOccuped[]    findAll()
 * @method EmployeOccuped[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeOccupedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeOccuped::class);
    }

    // /**
    //  * @return EmployeOccuped[] Returns an array of EmployeOccuped objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EmployeOccuped
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
