<?php

namespace App\Repository;

use App\Entity\Commandes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commandes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commandes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commandes[]    findAll()
 * @method Commandes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commandes::class);
    }

    // /**
    //  * @return Commandes[] Returns an array of Commandes objects
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
    public function findOneBySomeField($value): ?Commandes
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

    public function random_code($length = 10){

    	$randomString = '';
    	$dateyear = date('Y');
        $suffix='CM';

        $conn = $this->connectBase();

        $sql = "SELECT LPAD(MAX(Maxcount)+1,6,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(code_commande,'".$suffix."','') AS UNSIGNED)) as Maxcount from commandes cm WHERE YEAR(cm.com_created_at)='".$dateyear."')t";

        $stmt = $conn->executeQuery($sql);
        $data = $stmt->fetchAllAssociative();
            
             foreach ($data as $key => $value) {
                
                if($value['Maxcounts']==NULL){
                    $Countmax="000001";
                }else{
                    $Countmax=$value['Maxcounts'];
                }
             }

        $randomString = $suffix.''.$Countmax;

        return $randomString;
    }

    public function select_last()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }
    public function collectDetail($idC) {
        $connect = $this->connectBase();

        $query =    "SELECT * FROM commande_detail CD 
                    LEFT JOIN services as SV ON SV.id = CD.services_id
                    WHERE CD.commandes_id = ".$idC."
                    ";

        $stmt = $connect->executeQuery($query);
        $data = $stmt->fetchAllAssociative();

        return $data;
    }
}
