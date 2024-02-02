<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntradaController extends AbstractController
{
    #[Route('/entrada', name: 'app_entrada')]
    public function index(): Response
    {
        return $this->render('entrada/index.html.twig', [
            'controller_name' => 'EntradaController',
        ]);
    }
}
