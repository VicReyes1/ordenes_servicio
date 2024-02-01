<?php

namespace App\Repository;

use App\Entity\Secretaria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Secretaria>
 *
 * @method Secretaria|null find($id, $lockMode = null, $lockVersion = null)
 * @method Secretaria|null findOneBy(array $criteria, array $orderBy = null)
 * @method Secretaria[]    findAll()
 * @method Secretaria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecretariaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Secretaria::class);
    }

//    /**
//     * @return Secretaria[] Returns an array of Secretaria objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Secretaria
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
