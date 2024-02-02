<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalidaController extends AbstractController
{
    #[Route('/salida', name: 'app_salida')]
    public function index(): Response
    {
        return $this->render('salida/index.html.twig', [
            'controller_name' => 'SalidaController',
        ]);
    }
}
