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

    public function findCapturasWithSecretaria(): array
    {
        return $this->createQueryBuilder('c')
        ->leftJoin('c.secretaria', 's') // Realiza un left join con la relación 'secretaria'
        ->addSelect('s') // Selecciona la entidad 'Secretaria' para incluir sus campos
        ->where('c.nombre_proyecto IS NULL')
        ->orderBy('c.id', 'ASC')
        ->getQuery()
        ->getResult();
    
    }

    public function findById($value): ?array
    {
        return $this->createQueryBuilder('e')
            ->select('e.id, e.fecha', 'e.area_solicitante', 'e.centro_trabajo', 'e.nombre_solicitante', 'e.puesto_solicitante', 'e.telefono_ext', 'e.tipo_trabajo', 'e.descripcion_trabajo')
            ->andWhere('e.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }


}
