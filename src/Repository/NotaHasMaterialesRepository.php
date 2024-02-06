<?php

namespace App\Repository;

use App\Entity\NotaHasMateriales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NotaHasMateriales>
 *
 * @method NotaHasMateriales|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotaHasMateriales|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotaHasMateriales[]    findAll()
 * @method NotaHasMateriales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotaHasMaterialesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotaHasMateriales::class);
    }

//    /**
//     * @return NotaHasMateriales[] Returns an array of NotaHasMateriales objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NotaHasMateriales
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
