<?php

namespace App\Repository;

use App\Entity\CommandeDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeDetail[]    findAll()
 * @method CommandeDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeDetail::class);
    }

    // /**
    //  * @return CommandeDetail[] Returns an array of CommandeDetail objects
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
    public function findAllCommand($value)
    {
        return $this->createQueryBuilder('c')
            // ->andWhere('c.')
            ->groupBy('c.command_id')
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function connectBase() {
        return $this->getEntityManager()->getConnection();
    }

    public function collectCommand($value)
    {
        $connect = $this->connectBase();

        $query = "SELECT *, c.id as idC from commande_detail as cd 
                    left join commandes as c on c.id = cd.commandes_id
                    where c.author_id = ".$value." group by c.id";
        
        $stmt = $connect->executeQuery($query);
        $data = $stmt->fetchAllAssociative();

        return $data;
    }

    public function collectEmployee()
    {
        $connect = $this->connectBase();

        $query = "SELECT * FROM employee AS EM WHERE EM.id NOT IN (
        SELECT EOE.employee_id FROM employe_occuped_employee AS EOE
        LEFT JOIN employe_occuped AS EO ON EO.id = EOE.employe_occuped_id
        WHERE EO.temps_occupe LIKE '%avant-midi%'
        )";
        
        $stmt = $connect->executeQuery($query);
        $data = $stmt->fetchAllAssociative();

        return $data;
    }

    public function employeeTaken($value)
    {
        $connect = $this->connectBase();

        $query = "SELECT * FROM employee AS EM WHERE EM.id IN (
        SELECT EOE.employee_id FROM employe_occuped_employee AS EOE
        LEFT JOIN employe_occuped AS EO ON EO.id = EOE.employe_occuped_id
        WHERE EO.commandeid = '".$value."')";
        
        $stmt = $connect->executeQuery($query);
        $data = $stmt->fetchAllAssociative();

        return $data;
    }

    /*
    public function findOneBySomeField($value): ?CommandeDetail
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
