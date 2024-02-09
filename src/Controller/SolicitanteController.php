<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Captura;
use App\Entity\Secretaria;
use App\Entity\Material;
use App\Entity\Nota;
use App\Entity\Salida;
use App\Entity\NotaHasMateriales;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

        $imagen1File = $request->files->get('imagen1');
        $imagen2File = $request->files->get('imagen2');
        $imagen3File = $request->files->get('imagen3');

        // Verificar si se cargó la imagen 1
        if ($imagen1File instanceof UploadedFile) {
            // Procesar y guardar la imagen 1
            $this->handleImage($captura, $imagen1File, 'imagen1');
        }

        // Verificar si se cargó la imagen 2
        if ($imagen2File instanceof UploadedFile) {
            // Procesar y guardar la imagen 2
            $this->handleImage($captura, $imagen2File, 'imagen2');
        }

        if ($imagen3File instanceof UploadedFile) {
            // Procesar y guardar la imagen 2
            $this->handleImage($captura, $imagen3File, 'imagen3');
        }

        $this->entityManager->persist($nota);

        // Antes de hacer el flush, puedes obtener el ID
        $notaId = $nota->getId();

        // Luego, haces el flush
        $this->entityManager->flush();

        for ($i = 0; $i < sizeof($materiales); $i++) {
            $notaHasMateriales = new NotaHasMateriales();
            $salida = new Salida();
            $material = $this->entityManager->getRepository(Material::class)->find($materiales[$i]); // Corregir $material[$i]
            $cantidad = $cantidades[$i];

            // Asigna la relación con Nota y Material
            $notaHasMateriales->setNota($nota);
            $notaHasMateriales->setMaterial($material);
            $notaHasMateriales->setCantidad($cantidad);

            $salida->setCaptura($captura);
            $salida->setFecha($fechaActual);
            $salida->setMaterial($material);
            $salida->setCantidad($cantidad);
            $salida->setNota($nota);

            // Persiste el objeto NotaHasMateriales
            $this->entityManager->persist($notaHasMateriales);
            $this->entityManager->persist($salida);
        }

        // Haz el flush después de agregar todas las relaciones
        $this->entityManager->flush();

        // Haz lo que necesites con los datos

        // Redirige a donde sea necesario
        $url = $urlGenerator->generate('app_proyecto_solicitante', ['id' => $id]);

        return new RedirectResponse($url);
    }

    private function handleImage(Captura $captura, UploadedFile $file, string $fieldName): string
    {
        // Definir el directorio de destino para las imágenes
        $uploadDirectory = $this->getParameter('app.upload_directory');

        // Generar un nombre único para el archivo
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        // Mover el archivo al directorio de destino
        $file->move($uploadDirectory, $fileName);

        // Obtener la ruta completa del archivo
        $filePath = $uploadDirectory . '/' . $fileName;

        // Reducir la calidad de la imagen a un valor específico (puedes ajustar según tus necesidades)
        $this->reduceImageQuality($filePath, 10); // 60 es el nivel de calidad (0-100)

        // Actualizar el campo correspondiente en la entidad Captura
        $setter = 'set' . ucfirst($fieldName);
        $captura->$setter($fileName);

        // Devolver la ruta del archivo
        return $filePath;
    }

    private function reduceImageQuality(string $filePath, int $quality): void
    {
        
        list($width, $height, $type) = getimagesize($filePath);

        // Determinar el tipo de imagen y cargar la imagen
        switch ($type) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($filePath);
                // Reducir la calidad de la imagen JPEG
                imagejpeg($image, $filePath, $quality);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($filePath);
                // Reducir la calidad de la imagen PNG
                imagepng($image, $filePath, round(9 * $quality / 100));
                break;
            // Puedes agregar más casos para otros tipos de imágenes según sea necesario
        }

        // Liberar la memoria
        imagedestroy($image);
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
