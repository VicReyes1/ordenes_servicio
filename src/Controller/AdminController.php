<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Captura;

class AdminController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        $proyectosWithSecretaria = $this->entityManager->getRepository(Captura::class)->findProyectosWithSecretaria();
        
        return $this->render('admin/index.html.twig', [
            'capturas' => $proyectosWithSecretaria,
        ]);
    }

    #[Route('/proyecto/{id}', name: 'app_proyecto')]
    public function proyecto($id): Response
    {
        $captura = $this->entityManager->getRepository(Captura::class)->findById($id);
        $captura['fecha'] = $captura['fecha']->format('Y-m-d');
        
        return $this->render('admin/verProyecto.html.twig', [
            'data' => $captura,
        ]);
    }
}
