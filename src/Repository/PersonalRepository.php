<?php

namespace App\Repository;

use App\Entity\Personal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Personal>
 *
 * @method Personal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personal[]    findAll()
 * @method Personal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personal::class);
    }

    public function getPersonalWithOcupacion(): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.ocupacion', 'o')
            ->select(
                'p.id',
                'p.nombre',
                'o.ocupacion'
            )
            ->getQuery()
            ->getResult();
    }
}
