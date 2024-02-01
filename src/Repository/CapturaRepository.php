<?php

namespace App\Repository;

use App\Entity\Captura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Captura>
 *
 * @method Captura|null find($id, $lockMode = null, $lockVersion = null)
 * @method Captura|null findOneBy(array $criteria, array $orderBy = null)
 * @method Captura[]    findAll()
 * @method Captura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Captura::class);
    }

//    /**
//     * @return Captura[] Returns an array of Captura objects
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

//    public function findOneBySomeField($value): ?Captura
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
