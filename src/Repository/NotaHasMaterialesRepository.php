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


    public function getAllMaterialesInNota($capturaID): array
    {
        return $this->createQueryBuilder('nhm')
            ->select('m.id', 'm.nombre', 'm.unidad_medida', 'c.nombre as categoria', 'nhm.cantidad') // Agregando 'c.nombre' para obtener el nombre de la categoría
            ->join('nhm.Material', 'm') // Usar 'material' con "m" minúscula
            ->join('m.categoria', 'c') // Agregar join con la entidad Categoria
            ->join('nhm.nota', 'n') // Ajustar 'nota' según la relación en tu entidad NotaHasMateriales
            ->where('n.id = :capturaID') // Ajustar 'id' según la propiedad id en tu entidad Nota
            ->setParameter('capturaID', $capturaID)
            ->getQuery()
            ->getResult();
    }

}
