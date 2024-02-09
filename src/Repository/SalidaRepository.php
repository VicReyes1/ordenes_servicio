<?php

namespace App\Repository;

use App\Entity\Salida;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Salida>
 *
 * @method Salida|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salida|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salida[]    findAll()
 * @method Salida[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalidaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Salida::class);
    }

    public function findWithInfo(): array
    {
        return $this->createQueryBuilder('s')
        ->addSelect('s.id,s.fecha,s.cantidad')
        ->leftJoin('s.material', 'm') 
        ->addSelect('m.nombre as nombre_material') 
        ->leftJoin('s.captura', 'c') 
        ->addSelect('c.nombre_proyecto, c.id as captura_id')
        ->leftJoin('s.nota', 'n') 
        ->addSelect('n.nombre as nombre_nota,n.id as nota_id')
        ->orderBy('s.id', 'ASC')
        ->getQuery()
        ->getResult();
    
    }

//    /**
//     * @return Salida[] Returns an array of Salida objects
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

//    public function findOneBySomeField($value): ?Salida
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
