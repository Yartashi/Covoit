<?php

namespace App\Repository;

use App\Entity\Trajet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @method Trajet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trajet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trajet[]    findAll()
 * @method Trajet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrajetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trajet::class);
    }

    /**
    * @return Trajet[] Returns an array of Trajet objects
    */
    public function searchTrajets(Trajet $trajet)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT t
            FROM App\Entity\Trajet t
            WHERE t.villeDep = :villeDep
            AND t.villeDest = :villeDest
            AND t.dateDep = :dateDep
            AND t.statut = :statut
            ORDER BY t.id ASC'
        )-> setParameter('villeDep', $trajet->getVilleDep())
        ->setParameter('villeDest', $trajet->getVilleDest())
        ->setParameter('dateDep', $trajet->getDateDep())
        ->setParameter('statut', $trajet->getStatut())
        ;
        //NE FONCTIONNE PAS CAR IL NE COMPREND PAS LES WHERES
        /*
        $this->createQueryBuilder('t');
            if($trajet->getVilleDep() != ""){
                $this->andWhere('t.villeDep = :villeDep')
                ->setParameter('villeDep', $trajet->getVilleDep());
            }
            
            if($trajet->getVilleDest() != ""){
                $this->andWhere('t.villeDest = :villeDest')
                ->setParameter('villeDest', $trajet->getVilleDest());
            }
            
            if ($trajet->getDateDep() != null){
                $this->andWhere('t.dateDep = :dateDep')
                ->setParameter('dateDep', $trajet->getDateDep());
            }
            
            $this->andWhere('t.statut = :statut')
            ->setParameter('statut', $trajet->getStatut());
            $this->orderBy('t.id', 'ASC')
            
            ->getQuery()
            ->getResult()
        ;*/
        return $query->getResult();
    }

    /**
    * @return Trajet[] Returns an array of Trajet objects
    */
    public function last5Trajets()
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT t
            FROM App\Entity\Trajet t
            ORDER BY t.id DESC');
            $query->setMaxResults(5);
        return $query->getResult();
    }

    // /**
    //  * @return Trajet[] Returns an array of Trajet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trajet
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
