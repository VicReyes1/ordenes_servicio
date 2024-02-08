<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Inspector;
use App\Entity\Captura;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\Image;

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
        $captura['fecha'] = $captura['fecha']->format('Y-m-d');
       

        /*if (!$captura) {
            // Manejar la situación en la que no se encuentra la captura
            throw $this->createNotFoundException('No se encontró la captura con ID: ' . $id);
        }*/

        // Ahora, $captura contiene la información de la captura con el ID proporcionado

        return $this->render('inspector/inspeccion.html.twig', [
            'data' => $captura,
            
        ]);
    }

    #[Route('/inspector/iniciar-inspeccion/edit/{id}', name: 'app_iniciar_inspeccion_edit')]
    public function iniciarInspeccionEdit(Request $request, $id): Response
    {
        // Obtener los datos del formulario
        // Suponiendo que $entityManager es tu EntityManager
        $captura = $this->entityManager->getRepository(Captura::class)->find($id);

        // $id es el identificador del objeto que estás buscando

        $data = $request->request->all();

        // Manejar las imágenes
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
        
       
        foreach ($data as $key => $value) {
            
            // Verificar si existe el setter correspondiente en la entidad Registro
            $setter = 'set' . str_replace('_', '', ucwords($key, '_'));
            
                if (method_exists($captura, $setter)) {
                    $captura->$setter($value);
                }
            
        }

        date_default_timezone_set('America/Mexico_City');
        $fechaActual = new \DateTime();
        $captura->setFechaRevision($fechaActual);
        $this->entityManager->persist($captura);
        $this->entityManager->flush();

        
        //$this->addFlash('success', 'Captura guardada exitosamente');
        return $this->redirectToRoute('app_inspector');
        
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
    
}
