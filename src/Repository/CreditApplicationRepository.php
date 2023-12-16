<?php

namespace App\Repository;

use App\Entity\CreditApplication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CreditApplication>
 *
 * @method CreditApplication|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreditApplication|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreditApplication[]    findAll()
 * @method CreditApplication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreditApplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditApplication::class);
    }

//    /**
//     * @return CreditApplication[] Returns an array of CreditApplication objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CreditApplication
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
