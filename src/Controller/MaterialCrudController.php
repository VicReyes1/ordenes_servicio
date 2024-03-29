<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use App\Repository\MaterialRepository;
use App\Repository\EntradaRepository;
use App\Repository\SalidaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/material/crud')]
class MaterialCrudController extends AbstractController
{
    #[Route('/', name: 'app_material_crud_index', methods: ['GET'])]
    public function index(MaterialRepository $materialRepository): Response
    {
        return $this->render('material_crud/index.html.twig', [
            'materials' => $materialRepository->findAll(),
        ]);
    }

    #[Route('/inventario', name: 'app_material_inventario')]
    public function inventario(EntradaRepository $entradaRepository, SalidaRepository $salidaRepository, MaterialRepository $materialRepository): Response
    {
        // Obtén las entradas y salidas desde tus repositorios
        $entradas = $entradaRepository->findAll();
        $salidas = $salidaRepository->findAll();
        $materiales = $materialRepository->findAll();

        // Inicializa el array de inventario por material
        $inventarioPorMaterial = [];

        // Calcula el inventario por material
        foreach ($materiales as $material) {
            $inventario = 0;

            foreach ($entradas as $entrada) {
                if ($entrada->getMaterial() === $material) {
                    $inventario += $entrada->getCantidad();
                }
            }

            foreach ($salidas as $salida) {
                if ($salida->getMaterial() === $material) {
                    $inventario -= $salida->getCantidad();
                }
            }

            $inventarioPorMaterial[$material->getId()] = $inventario;
        }

        // Pasa el resultado a la plantilla
        return $this->render('material_crud/inventario.html.twig', [
            'materiales' => $materiales,
            'entradas' => $entradas,
            'salidas' => $salidas,
            'inventarioPorMaterial' => $inventarioPorMaterial,
        ]);
    }

    #[Route('/new', name: 'app_material_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $material = new Material();
        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($material);
            $entityManager->flush();

            return $this->redirectToRoute('app_material_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('material_crud/new.html.twig', [
            'material' => $material,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_material_crud_show', methods: ['GET'])]
    public function show(Material $material): Response
    {
        return $this->render('material_crud/show.html.twig', [
            'material' => $material,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_material_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Material $material, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_material_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('material_crud/edit.html.twig', [
            'material' => $material,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_material_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Material $material, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$material->getId(), $request->request->get('_token'))) {
            $entityManager->remove($material);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_material_crud_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route("/obtener-precio/{id}", name:"obtener_precio_material", methods:["GET"])]
    public function obtenerPrecio(MaterialRepository $materialRepository, $id): Response
    {
        $material = $materialRepository->find($id);

        if (!$material) {
            return $this->json(['error' => 'Material no encontrado'], 404);
        }

        $precio = $material->getPrecio();

        // Asegúrate de devolver un JsonResponse en lugar de simplemente $this->json
        return $this->json(['precio' => $precio]);
    }


}
