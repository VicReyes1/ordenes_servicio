<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Inspector;
use App\Entity\Captura;
use Doctrine\ORM\EntityManagerInterface;

class InspectorController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/inspector', name: 'app_inspector')]
    public function index(): Response
    {
        $capturasWithSecretaria = $this->entityManager->getRepository(Captura::class)->findCapturasWithSecretaria();

        return $this->render('inspector/index.html.twig', [
            'capturas' => $capturasWithSecretaria,
        ]);
    }

    #[Route('/inspector/iniciar-inspeccion/{id}', name: 'app_iniciar_inspeccion')]
    public function iniciarInspeccion($id): Response
    {
        

        // Buscar la captura por su ID
        
        $captura = $this->entityManager->getRepository(Captura::class)->findById($id);
        $captura['fecha'] = $captura['fecha']->format('Y-m-d');
       

        /*if (!$captura) {
            // Manejar la situación en la que no se encuentra la captura
            throw $this->createNotFoundException('No se encontró la captura con ID: ' . $id);
        }*/

        // Ahora, $captura contiene la información de la captura con el ID proporcionado

        return $this->render('inspector/inspeccion.html.twig', [
            'data' => $captura,
            
        ]);
    }

    #[Route('/inspector/iniciar-inspeccion/edit/{id}', name: 'app_iniciar_inspeccion_edit')]
    public function iniciarInspeccionEdit(Request $request, $id): Response
    {
        // Obtener los datos del formulario
        // Suponiendo que $entityManager es tu EntityManager
        $captura = $this->entityManager->getRepository(Captura::class)->find($id);

        // $id es el identificador del objeto que estás buscando

        $data = $request->request->all();

        
       
        foreach ($data as $key => $value) {
            
            // Verificar si existe el setter correspondiente en la entidad Registro
            $setter = 'set' . str_replace('_', '', ucwords($key, '_'));
            
                if (method_exists($captura, $setter)) {
                    $captura->$setter($value);
                }
            
        }

        date_default_timezone_set('America/Mexico_City');
        $fechaActual = new \DateTime();
        $captura->setFechaRevision($fechaActual);
        $this->entityManager->persist($captura);
        $this->entityManager->flush();

        
        //$this->addFlash('success', 'Captura guardada exitosamente');
        return $this->redirectToRoute('app_inspector');
        
    }

    
}
