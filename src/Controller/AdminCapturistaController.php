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
        // Ejemplo de uso en un controlador
        
        
        
        //$capturasWithSecretaria = $this->entityManager->getRepository(Captura::class)->findCapturasWithSecretaria();

        
        return $this->render('admin_capturista/index.html.twig', [
            
        ]);
    }

    #[Route('/capturas/add', name: 'app_admin_capturista_add')]
    public function capturasAdd(): Response
    {
        $secretarias = $this->entityManager->getRepository(Secretaria::class)->findAll();
        
        return $this->render('admin_capturista/add_captura.html.twig', [
            'secretarias' => $secretarias
        ]);
    }

    #[Route('/capturas/add-action', name: 'app_admin_capturista_add_action')]
    public function capturasAddAction(Request $request): Response
    {
        // Obtener los datos del formulario
        $captura = new Captura();
        $data = $request->request->all();

       
        foreach ($data as $key => $value) {
            
            // Verificar si existe el setter correspondiente en la entidad Registro
            $setter = 'set' . str_replace('_', '', ucwords($key, '_'));
            if ($key == 'secretaria') {
                $captura->setSecretaria($this->entityManager->getRepository(Secretaria::class)->find($data['secretaria']));
            }else{
                if (method_exists($captura, $setter)) {
                    $captura->$setter($value);
                }
            }
            
        }

        date_default_timezone_set('America/Mexico_City');
        $fechaActual = new \DateTime();
        $captura->setFecha($fechaActual);
        $this->entityManager->persist($captura);
        $this->entityManager->flush();
        
        $this->addFlash('success', 'Captura guardada exitosamente');
        return $this->redirectToRoute('app_admin_capturista');
        
    }
}
