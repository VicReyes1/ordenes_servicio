<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InspectorController extends AbstractController
{
    #[Route('/inspector', name: 'app_inspector')]
    public function index(): Response
    {
        return $this->render('inspector/index.html.twig', [
            'controller_name' => 'InspectorController',
        ]);
    }
}
