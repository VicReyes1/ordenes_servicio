<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Captura;
use App\Entity\Nota;
use App\Entity\User;
use App\Entity\NotaHasMateriales;

class AdminController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/createUser', name: 'app_createUser')]
    public function guardarUsuario(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        $usuario = new User();
        $usuario
            
            ->setEmail($data['email'])
            ->setPassword(password_hash($data['password'], PASSWORD_DEFAULT)) // Hashear la contraseña
            ->setRoles($data['roles'])
            ->setNombreCompleto($data['nombre'])
            ->setCargo($data['cargo']);
            
        // Persistir y guardar el usuario en la base de datos
        $entityManager->persist($usuario);
        $entityManager->flush();

        // Retorna una respuesta adecuada (por ejemplo, un mensaje de éxito)
        return new Response('Usuario guardado correctamente', Response::HTTP_CREATED);
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
        $notasAceptadas = $this->entityManager->getRepository(Nota::class)->getAllAceptedNotas($id);
        $notasPendientes = $this->entityManager->getRepository(Nota::class)->getAllPendingNotas($id);
        $notasRechazadas = $this->entityManager->getRepository(Nota::class)->getAllRefusedNotas($id);
        
        return $this->render('admin/verProyecto.html.twig', [
            'data' => $captura,
            'aceptadas' => $notasAceptadas,
            'pendientes' => $notasPendientes,
            'recahazadas' => $notasRechazadas
        ]);
    }

    #[Route('/proyecto/nota/{id}', name: 'proyecto_ver_nota')]
    public function solicitanteNota($id): Response
    {
       
        $nota = $this->entityManager->getRepository(Nota::class)->find($id);
        $materiales = $this->entityManager->getRepository(NotaHasMateriales::class)->getAllMaterialesInNota($id);

        
        return $this->render('admin/verNota.html.twig', [
            'nota' => $nota,
            'materiales' => $materiales
        ]);
    }

    #[Route('/aceptar/{id}', name: 'proyecto_aceptar_nota')]
    public function aceptarNota($id): Response
    {
        $nota = $this->entityManager->getRepository(Nota::class)->find($id);
        $nota->setEstatus('aceptado');

        $idProyecto = $nota->getCaptura()->getId();
        $this->entityManager->persist($nota);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_proyecto', ['id' => $idProyecto]);

    }

    #[Route('/rechazar/{id}', name: 'proyecto_rechazar_nota')]
    public function rechazarNota($id): Response
    {
        $nota = $this->entityManager->getRepository(Nota::class)->find($id);
        $nota->setEstatus('rechazado');

        $idProyecto = $nota->getCaptura()->getId();
        $this->entityManager->persist($nota);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_proyecto', ['id' => $idProyecto]);

    }
}
