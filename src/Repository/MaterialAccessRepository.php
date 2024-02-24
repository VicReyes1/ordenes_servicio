<?php

namespace App\Repository;

use App\Entity\MaterialAccess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MaterialAccess>
 *
 * @method MaterialAccess|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaterialAccess|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaterialAccess[]    findAll()
 * @method MaterialAccess[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterialAccessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaterialAccess::class);
    }

//    /**
//     * @return MaterialAccess[] Returns an array of MaterialAccess objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MaterialAccess
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
