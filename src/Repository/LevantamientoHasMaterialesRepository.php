<?php

namespace App\Repository;

use App\Entity\LevantamientoHasMateriales;
use App\Entity\Entrada; // Importa la entidad Entrada
use App\Entity\Salida; 
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LevantamientoHasMateriales>
 *
 * @method LevantamientoHasMateriales|null find($id, $lockMode = null, $lockVersion = null)
 * @method LevantamientoHasMateriales|null findOneBy(array $criteria, array $orderBy = null)
 * @method LevantamientoHasMateriales[]    findAll()
 * @method LevantamientoHasMateriales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LevantamientoHasMaterialesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LevantamientoHasMateriales::class);
    }

    public function findMateriales($levantamientoID): array
    {
        $materiales = $this->createQueryBuilder('lhm')
            ->select('lhm.id, lhm.cantidad, m.nombre as nombre_material, m.descripcion, m.familia, m.subfamilia, m.unidad_medida, m.id as id_material')
            ->leftJoin('lhm.material', 'm')
            ->where('lhm.levantamiento = :levantamientoID')  // Asumiendo el nombre de la relación
            ->setParameter('levantamientoID', $levantamientoID)
            ->getQuery()
            ->getResult();

            
        foreach ($materiales as &$material) {
            $idMaterial = $material['id_material'];
            
            $cantidadEntradas = $this->getEntityManager()->getRepository(Entrada::class)
                ->createQueryBuilder('e')
                ->select('SUM(e.cantidad)')
                ->andWhere('e.material = :idMaterial')
                ->setParameter('idMaterial', $idMaterial)
                ->getQuery()
                ->getSingleScalarResult();
            

            $cantidadSalidas = $this->getEntityManager()->getRepository(Salida::class)
                ->createQueryBuilder('s')
                ->select('SUM(s.cantidad)')
                ->andWhere('s.material = :idMaterial')
                ->setParameter('idMaterial', $idMaterial)
                ->getQuery()
                ->getSingleScalarResult();

            $material['cantidad_actual'] = $cantidadEntradas - $cantidadSalidas;
        }

        return $materiales;
    }

}
