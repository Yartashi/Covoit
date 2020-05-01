<?php

namespace App\Repository;

use App\Entity\DateInscr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DateInscr|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateInscr|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateInscr[]    findAll()
 * @method DateInscr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateInscrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateInscr::class);
    }

    // /**
    //  * @return DateInscr[] Returns an array of DateInscr objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DateInscr
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
