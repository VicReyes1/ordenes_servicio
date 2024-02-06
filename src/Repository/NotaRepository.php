<?php

namespace App\Repository;

use App\Entity\Nota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Nota>
 *
 * @method Nota|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nota|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nota[]    findAll()
 * @method Nota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nota::class);
    }


    public function getAllAceptedNotas($capturaID): array
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.captura = :capturaID')
            ->andWhere('n.estatus = :aceptado') // Ajusta según tu mapeo de entidad
            ->setParameter('capturaID', $capturaID)
            ->setParameter('aceptado', 'aceptado') // Ajusta según los valores reales de tu estatus
            ->getQuery()
            ->getResult();
    }

    public function getAllPendingNotas($capturaID): array
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.captura = :capturaID')
            ->andWhere('n.estatus = :pendiente') // Ajusta según tu mapeo de entidad
            ->setParameter('capturaID', $capturaID)
            ->setParameter('pendiente', 'pendiente') // Ajusta según los valores reales de tu estatus
            ->getQuery()
            ->getResult();
    }

    public function getAllRefusedNotas($capturaID): array
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.captura = :capturaID')
            ->andWhere('n.estatus = :rechazado') // Ajusta según tu mapeo de entidad
            ->setParameter('capturaID', $capturaID)
            ->setParameter('rechazado', 'rechazado') // Ajusta según los valores reales de tu estatus
            ->getQuery()
            ->getResult();
    }
}
