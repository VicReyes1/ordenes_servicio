<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Captura;
use App\Entity\Secretaria;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class AdminCapturistaController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/capturas', name: 'app_admin_capturista')]
    public function index(): Response
    {

        return $this->render('admin_capturista/index.html.twig', [
            'controller_name' => 'AdminCapturistaController',
        ]);
    }

    #[Route('/capturas/add', name: 'app_admin_capturista_add')]
    public function capturasAdd(): Response
    {
        
        return $this->render('admin_capturista/add_captura.html.twig', [
            'controller_name' => 'AdminCapturistaController',
        ]);
    }

    #[Route('/capturas/add-action', name: 'app_admin_capturista_add_action')]
    public function capturasAddAction(Request $request): Response
    {
        // Obtener los datos del formulario
        $captura = new Captura();


        $fecha = $request->request->get('fecha');
        $areaSolicitante = $request->request->get('area_solicitante');
        $centroTrabajo = $request->request->get('centro_trabajo');
        $nombreSolicitante = $request->request->get('nombre_solicitante');
        $puestoSolicitante = $request->request->get('puesto_solicitante');
        $telefonoExt = $request->request->get('telefono_ext');
        $tipoTrabajo = $request->request->get('tipo_trabajo');
        $descripcionTrabajo = $request->request->get('descripcion_trabajo');
        $secretaria = $request->request->get('secretaria');

        
        $fechaf = new \DateTime($fecha);
        $captura->setFecha($fechaf);
        $captura->setSecretaria($this->entityManager->getRepository(Secretaria::class)->find($data['secretaria']));
        $this->entityManager->persist($captura);
        $this->entityManager->flush();
        
        return $this->redirectToRoute('app_admin_capturista_add');
    }
}
