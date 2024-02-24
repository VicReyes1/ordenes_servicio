<?php

namespace App\Repository;

use App\Entity\CapturaHasPersonal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CapturaHasPersonal>
 *
 * @method CapturaHasPersonal|null find($id, $lockMode = null, $lockVersion = null)
 * @method CapturaHasPersonal|null findOneBy(array $criteria, array $orderBy = null)
 * @method CapturaHasPersonal[]    findAll()
 * @method CapturaHasPersonal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapturaHasPersonalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CapturaHasPersonal::class);
    }

//    /**
//     * @return CapturaHasPersonal[] Returns an array of CapturaHasPersonal objects
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

//    public function findOneBySomeField($value): ?CapturaHasPersonal
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
