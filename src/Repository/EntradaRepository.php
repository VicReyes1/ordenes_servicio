<?php

namespace App\Repository;

use App\Entity\Entrada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Entrada>
 *
 * @method Entrada|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entrada|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entrada[]    findAll()
 * @method Entrada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntradaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entrada::class);
    }

    public function AllWithPrice($materialId): ?array
    {
        $result = $this->createQueryBuilder('e')
            ->select('e.id, e.precio_adquirido, e.precio_adquirido, e.cantidad, e.fecha') // Asegúrate de seleccionar la fecha
            ->leftJoin('e.material', 'm')
            ->andWhere('m.id = :materialId')
            ->setParameter('materialId', $materialId)
            ->getQuery()
            ->getResult();

        // Formatear la fecha antes de devolver los resultados
        foreach ($result as &$entry) {
            $entry['fecha'] = $entry['fecha']->format('d/m/Y H:i:s'); // Formato día/mes/año
        }

        return $result;
    }

    public function findEntradasInNota($notaID): array
    {
        return $this->createQueryBuilder('e')
            ->select('e.id, e.fecha, e.cantidad, m.nombre as nombre_material, m.unidad_medida ,e.precio_adquirido')
            ->leftJoin('e.material', 'm') 
            ->leftJoin('e.nota', 'n') 
            ->where('n.id = :notaID')  // Añade la condición para el parámetro :notaID
            ->setParameter('notaID', $notaID)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult();
    }



}
