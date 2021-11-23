<?php

namespace App\Repository;

use App\Entity\CommandesPaie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandesPaie|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandesPaie|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandesPaie[]    findAll()
 * @method CommandesPaie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandesPaieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandesPaie::class);
    }

    // /**
    //  * @return CommandesPaie[] Returns an array of CommandesPaie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommandesPaie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function connectBase() {
        return $this->getEntityManager()->getConnection();
    }
    public function commandPaie($id)
    {
        $connect = $this->connectBase();

        $query = "SELECT * FROM commandes_paie WHERE commandesid = ".$id."";

        $stmt = $connect->executeQuery($query);
        $data = $stmt->fetchAllAssociative();
        $exist = true;

        if(empty($data)) {
            $exist = false;
        }else{
            $exist = true;
        }

        return $exist;
    }
}
