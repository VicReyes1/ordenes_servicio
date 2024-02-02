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
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


}
