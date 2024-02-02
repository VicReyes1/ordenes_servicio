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
        

        if (!$captura) {
            // Manejar la situación en la que no se encuentra la captura
            throw $this->createNotFoundException('No se encontró la captura con ID: ' . $id);
        }

        // Ahora, $captura contiene la información de la captura con el ID proporcionado

        return $this->render('inspector/inspeccion.html.twig', [
            'data' => $captura,
        ]);
    }

    
}
