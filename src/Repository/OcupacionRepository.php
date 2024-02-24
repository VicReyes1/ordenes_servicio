<?php

namespace App\Repository;

use App\Entity\Ocupacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ocupacion>
 *
 * @method Ocupacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ocupacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ocupacion[]    findAll()
 * @method Ocupacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OcupacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ocupacion::class);
    }

//    /**
//     * @return Ocupacion[] Returns an array of Ocupacion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ocupacion
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
