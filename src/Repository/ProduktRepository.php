<?php

namespace App\Repository;

use App\Entity\Kategoria;
use App\Entity\Produkt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produkt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produkt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produkt[]    findAll()
 * @method Produkt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduktRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produkt::class);
    }

    
    public function findByKategoria($values, $values_exclude)
    {
        $query = $this->createQueryBuilder('p')
                ->innerJoin('p.kategoria','kp');
        //Check if values is not empty and excluded values are empty
        //Add all values to be search to query
        if(!($values->isEmpty()) && $values_exclude->isEmpty()){
            foreach($values as $value){

                $query->OrWhere('kp.id = '.$value->getId());
            }
        } 
        //Check if values are empty and excluded values are not empty
        //Add all excluded values to be search to query_1 (sub-query)
        //Search for all produkt that are not in query_1 (subquery)
        else if($values->isEmpty() && !($values_exclude->isEmpty())){
            
            $query_1 = $this->createQueryBuilder('p')
            ->innerJoin('p.kategoria','kp');

            foreach($values_exclude as  $value_e){
                $query_1
                ->OrWhere('kp.id = '.$value_e->getId());
            }


            $query_2 = $this->createQueryBuilder('p1')
                            ->innerJoin('p1.kategoria','kp1');
            $query_2
                ->AndWhere($query_2->expr()->notIn('p1.id', $query_1->getDQL()));

            //Send result from two querys to value $query
            $query = $query_2;

        } 
        //Check if values are not empty and excluded values are not empty
        //Add all excluded values to be search to query_1 (sub-query)
        //Add all values to be search to query_2 (main-query)
        //Search for all produkt from query_2 (main-query) that are not in query_1 (subquery)
        else if((!$values->isEmpty()) && !($values_exclude->isEmpty())){

            $query_1 = $this->createQueryBuilder('p')
            ->innerJoin('p.kategoria','kp');

            foreach($values_exclude as  $value_e){
                $query_1
                ->OrWhere('kp.id = '.$value_e->getId());
            }

            $query_2 = $this->createQueryBuilder('p1')
                            ->innerJoin('p1.kategoria','kp1');

            foreach($values as $value){
                $query_2
                ->OrWhere('kp1.id = '.$value->getId());
            }

            $query_2
                ->AndWhere($query_2->expr()->notIn('p1.id', $query_1->getDQL()));
                
            //Send result from two querys to value $query
            $query = $query_2;
        }

        //Show result according received query
        return $query
                ->getQuery()
                ->getResult();


    }
    

    /*
    public function findOneBySomeField($value): ?Produkt
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
