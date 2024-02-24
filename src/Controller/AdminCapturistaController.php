<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Captura;
use App\Entity\Secretaria;
use App\Entity\Personal;
use App\Entity\Categoria;
use App\Entity\CapturaHasPersonal;
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
        
        $capturasWithSecretaria = $this->entityManager->getRepository(Captura::class)->findCapturasWithSecretaria();
        return $this->render('admin_capturista/index.html.twig', [
            'capturas' => $capturasWithSecretaria,  
        ]);
    }

    #[Route('/capturas/add', name: 'app_admin_capturista_add')]
    public function capturasAdd(): Response
    {
        $secretarias = $this->entityManager->getRepository(Secretaria::class)->findAll();
        $personal = $this->entityManager->getRepository(Personal::class)->getPersonalWithOcupacion();
        $categorias = $this->entityManager->getRepository(Categoria::class)->findAll();
        
        return $this->render('admin_capturista/add_captura.html.twig', [
            'secretarias' => $secretarias,
            'trabajadores' => $personal,
            'categorias' => $categorias
        ]);
    }

    #[Route('/capturas/add-action', name: 'app_admin_capturista_add_action')]
    public function capturasAddAction(Request $request): Response
    {
        
        $data = $request->request->all();
        //dd($data);
        $captura = new Captura();

        $captura
        ->setAreaSolicitante(trim($data['area_solicitante']))
        ->setCentroTrabajo(trim($data['centro_trabajo']))
        ->setNombreSolicitante(trim($data['nombre_solicitante']))
        ->setPuestoSolicitante(trim($data['puesto_solicitante']))
        ->setTelefonoExt(trim($data['telefono_ext']))
        ->setDescripcionTrabajo(trim($data['descripcion_trabajo']))
        ->setSecretaria($this->entityManager->getRepository(Secretaria::class)->find($data['secretaria']));

        date_default_timezone_set('America/Mexico_City');
        $fechaActual = new \DateTime();
        $captura->setFecha($fechaActual);
        $this->entityManager->persist($captura);
        $this->entityManager->flush();

        for ($i = 0; $i < $data['cantidad']; $i++) {
            $registro = new CapturaHasPersonal();
            $registro->setCaptura($this->entityManager->getRepository(Captura::class)->find($captura->getId()));
            $registro->setTipo($this->entityManager->getRepository(Categoria::class)->find($data['tipos'.$i]));
        
            for ($x = 0; $x < count($data['trabajadoresPersonal'.$i]); $x++) {
                $registroTrabajador = clone $registro;  // Clona el objeto $registro para crear uno nuevo
                $registroTrabajador->setTrabajador($this->entityManager->getRepository(Personal::class)->find($data['trabajadoresPersonal'.$i][$x]));
                $this->entityManager->persist($registroTrabajador);
            }
        }
        
        $this->entityManager->flush();
        
        
        
        $this->addFlash('success', 'Captura guardada exitosamente');
        return $this->redirectToRoute('app_admin_capturista');
        
    }
}
