<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Captura;
use App\Entity\Secretaria;
use App\Entity\Material;
use App\Entity\Nota;
use App\Entity\NotaHasMateriales;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SolicitanteController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/solicitante', name: 'app_solicitante')]
    public function index(): Response
    {
        $proyectosWithSecretaria = $this->entityManager->getRepository(Captura::class)->findProyectosWithSecretaria();
        
        
        return $this->render('solicitante/index.html.twig', [
            'capturas' => $proyectosWithSecretaria,
        ]);
    }

    #[Route('/solicitante/proyecto/{id}', name: 'app_proyecto_solicitante')]
    public function proyecto($id): Response
    {
        $captura = $this->entityManager->getRepository(Captura::class)->findById($id);
        $captura['fecha'] = $captura['fecha']->format('Y-m-d');
        $notasAceptadas = $this->entityManager->getRepository(Nota::class)->getAllAceptedNotas($id);
        $notasPendientes = $this->entityManager->getRepository(Nota::class)->getAllPendingNotas($id);
        $notasRechazadas = $this->entityManager->getRepository(Nota::class)->getAllRefusedNotas($id);
        
        return $this->render('solicitante/verProyecto.html.twig', [
            'data' => $captura,
            'aceptadas' => $notasAceptadas,
            'pendientes' => $notasPendientes,
            'recahazadas' => $notasRechazadas
        ]);
    }

    #[Route('/solicitante/crear-orden/{id}', name: 'app_solicitante_crear_orden')]
    public function crearOrden($id): Response
    {
        $materiales = $this->entityManager->getRepository(Material::class)->findAll();
       
        
        return $this->render('solicitante/agregarNotas.html.twig', [
            'materiales' => $materiales
        ]);
    }

    #[Route('/generar-nota/{id}', name: 'generar_nota')]
    public function guardarMateriales(Request $request, UrlGeneratorInterface $urlGenerator ,$id): Response
    {
        // Obtén los datos del formulario
        $data = $request->request->all();
        $materiales = $data['materiales'];
        $cantidades = $data['cantidades'];

        $nota = new Nota();

        $nota
            ->setNombre($data['nombre'])
            ->setObservaciones($data['observaciones'])
            ->setEstatus('pendiente'); // Establecer estatus pendiente

        date_default_timezone_set('America/Mexico_City');
        $fechaActual = new \DateTime();
        $nota->setFechaPeticion($fechaActual); // Cambiar setFechaPeticion

        // Captura la entidad Material
        $captura = $this->entityManager->getRepository(Captura::class)->find($id);

        // Establece la relación con Nota
        $nota->setCaptura($captura);

        $this->entityManager->persist($nota);

        // Antes de hacer el flush, puedes obtener el ID
        $notaId = $nota->getId();

        // Luego, haces el flush
        $this->entityManager->flush();

        for ($i = 0; $i < sizeof($materiales); $i++) {
            $notaHasMateriales = new NotaHasMateriales();
            $material = $this->entityManager->getRepository(Material::class)->find($materiales[$i]); // Corregir $material[$i]
            $cantidad = $cantidades[$i];

            // Asigna la relación con Nota y Material
            $notaHasMateriales->setNota($nota);
            $notaHasMateriales->setMaterial($material);
            $notaHasMateriales->setCantidad($cantidad);

            // Persiste el objeto NotaHasMateriales
            $this->entityManager->persist($notaHasMateriales);
        }

        // Haz el flush después de agregar todas las relaciones
        $this->entityManager->flush();

        // Haz lo que necesites con los datos

        // Redirige a donde sea necesario
        $url = $urlGenerator->generate('app_proyecto_solicitante', ['id' => $id]);

        return new RedirectResponse($url);
    }

    #[Route('/solicitante/nota/{id}', name: 'solicitante_ver_nota')]
    public function solicitanteNota($id): Response
    {
       
        $nota = $this->entityManager->getRepository(Nota::class)->find($id);
        $materiales = $this->entityManager->getRepository(NotaHasMateriales::class)->getAllMaterialesInNota($id);

        
        return $this->render('solicitante/verNota.html.twig', [
            'nota' => $nota,
            'materiales' => $materiales
        ]);
    }

}
