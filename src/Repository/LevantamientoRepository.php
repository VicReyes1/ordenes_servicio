<?php

namespace App\Repository;

use App\Entity\Levantamiento;
use App\Entity\CapturaHasPersonal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Levantamiento>
 *
 * @method Levantamiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Levantamiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Levantamiento[]    findAll()
 * @method Levantamiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LevantamientoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Levantamiento::class);
    }

    public function findLevantamientos(): array
    {
        return $this->createQueryBuilder('l')
            ->select('l.id, l.fecha_levantamiento, c.nombre as nombre_categoria')
            ->leftJoin('l.categoria', 'c')
            ->getQuery()
            ->getResult();
    }

    public function levantamientoWithCaptura($idLev): array
    {
        
        return $this->createQueryBuilder('l')
            ->select('l, l.fecha_levantamiento,captura.area_solicitante, captura.centro_trabajo, captura.nombre_solicitante, captura.puesto_solicitante, c.nombre as captura_nombre')
            ->leftJoin('l.categoria', 'c')
            ->leftJoin('l.captura', 'captura')
            ->where('l.id = :idLev')
            ->setParameter('idLev', $idLev)
            ->getQuery()
            ->getResult();
    }

    

}
