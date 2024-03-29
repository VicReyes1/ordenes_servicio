<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Form\EntradaType;
use App\Repository\EntradaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/entrada')]
class EntradaController extends AbstractController
{
    #[Route('/', name: 'app_entrada_index', methods: ['GET'])]
    public function index(EntradaRepository $entradaRepository): Response
    {
        return $this->render('entrada/index.html.twig', [
            'entradas' => $entradaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_entrada_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $entrada = new Entrada();
        $form = $this->createForm(EntradaType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($entrada);
            $entityManager->flush();

            return $this->redirectToRoute('app_entrada_index');
        }

        return $this->render('entrada/new.html.twig', [
            'entrada' => $entrada,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entrada_show', methods: ['GET'])]
    public function show(Entrada $entrada): Response
    {
        return $this->render('entrada/show.html.twig', [
            'entrada' => $entrada,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_entrada_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Entrada $entrada, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EntradaType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_entrada_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('entrada/edit.html.twig', [
            'entrada' => $entrada,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entrada_delete', methods: ['POST'])]
    public function delete(Request $request, Entrada $entrada, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entrada->getId(), $request->request->get('_token'))) {
            $entityManager->remove($entrada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_entrada_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
