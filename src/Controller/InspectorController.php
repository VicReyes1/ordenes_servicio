<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Inspector;
use App\Entity\Captura;
use App\Entity\Personal;
use App\Entity\Material;
use App\Entity\Levantamiento;
use App\Entity\Categoria;
use App\Entity\LevantamientoHasMateriales;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\Image;
use DateTimeInterface;
use mPDF;

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
        $materiales = $this->entityManager->getRepository(Material::class)->findAll();
        $personal = $this->entityManager->getRepository(Personal::class)->getPersonalWithOcupacion();
        $categorias = $this->entityManager->getRepository(Categoria::class)->findAll();
       

        /*if (!$captura) {
            // Manejar la situación en la que no se encuentra la captura
            throw $this->createNotFoundException('No se encontró la captura con ID: ' . $id);
        }*/

        // Ahora, $captura contiene la información de la captura con el ID proporcionado

        return $this->render('inspector/inspeccion.html.twig', [
            'data' => $captura,
            'materiales' => $materiales,
            'trabajadores' => $personal,
            'categorias' => $categorias
            
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
        $fechaString = $data['fecha'];
        $fechaObjeto = new \DateTime($fechaString);
        

        $levantamiento = new Levantamiento();
        $levantamiento
            ->setCaptura($captura)
            ->setCategoria($this->entityManager->getRepository(Categoria::class)->find($data['categoria']))
            ->setNombreSolicitante($data['nombre_solicitante'])
            ->setJefeCuadrilla($this->entityManager->getRepository(Personal::class)->find($data['jefe_cuadrilla']))
            ->setSupervisor($this->entityManager->getRepository(Personal::class)->find($data['supervisor']))
            ->setFechaLevantamiento($fechaObjeto);


        // AQUI ES DONDE COLOCARÁS EL ID DEL USUARIO DE LA SOLICITUD O USUARIO
		$idguardar = time();
		
		// AQUI VA EL NOMBRE DEL ARCHIVO DONDE SE VA A GUARDAR LA FIRMA
		// PUEDES TAMBIEN GUARDAR EN LA BD EL NOMBRE EL ARCHIVO
		$nomarch = "firma_sol".$idguardar.".png";

        $firmaFile1 = $this->base64_to_png($data['datos_imagen'],$nomarch);
        $levantamiento->setSolicitanteFirma($firmaFile1);

        $nomarch2 = "firma_jefe_cuad".$idguardar.".png";
        $firmaFile2 = $this->base64_to_png($data['datos_imagen_2'],$nomarch2);
        $levantamiento->setJefeCuadrillaFirma($firmaFile2);

        $nomarch3 = "firma_supervisor".$idguardar.".png";
        $firmaFile3 = $this->base64_to_png($data['datos_imagen_3'],$nomarch3);
        $levantamiento->setSupervisorFirma($firmaFile3);

        // Manejar las imágenes
        $imagen1File = $request->files->get('imagen1');
        $imagen2File = $request->files->get('imagen2');
        $imagen3File = $request->files->get('imagen3');

        // Verificar si se cargó la imagen 1
        if ($imagen1File instanceof UploadedFile) {
            // Procesar y guardar la imagen 1
            $this->handleImage($levantamiento, $imagen1File, 'imagen1');
        }

        // Verificar si se cargó la imagen 2
        if ($imagen2File instanceof UploadedFile) {
            // Procesar y guardar la imagen 2
            $this->handleImage($levantamiento, $imagen2File, 'imagen2');
        }

        if ($imagen3File instanceof UploadedFile) {
            // Procesar y guardar la imagen 2
            $this->handleImage($levantamiento, $imagen3File, 'imagen3');
        }

        $this->entityManager->persist($levantamiento);
        $this->entityManager->flush();

        for ($i=0; $i < sizeof($data['materiales']); $i++) { 
            $lhm = new LevantamientoHasMateriales;
            $lhm
            ->setLevantamiento($levantamiento)
            ->setMaterial($this->entityManager->getRepository(Material::class)->find($data['materiales'][$i]))
            ->setCantidad($data['cantidades'][$i]);
            $this->entityManager->persist($lhm);
        }
        $this->entityManager->flush();

        
        //$this->addFlash('success', 'Captura guardada exitosamente');
        $this->addFlash('success', 'Levantamiento generado exitosamente');
        return $this->redirectToRoute('app_proyecto',['id' => $id]);
        
    }

    private function handleImage(Levantamiento $levantamiento, UploadedFile $file, string $fieldName): string
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
        $levantamiento->$setter($fileName);

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

    #[Route('/generarInspeccionPDF/{id}', name: 'generar_proyecto_pdf_inspeccion')]
    public function generarPdf(Request $request, $id): Response
    {
        $levantamiento = $this->entityManager->getRepository(Levantamiento::class)->levantamientoWithCaptura($id);
        $materiales = $this->entityManager->getRepository(LevantamientoHasMateriales::class)->findMateriales($id);

        // Crear una instancia de mPDF
        $mpdf = new \Mpdf\Mpdf();

        // Renderizar la plantilla Twig y agregarla a la primera página
        $html = $this->renderView('inspector/imprimirInspeccion.html.twig', [
            'levantamiento' => $levantamiento,
            'materiales' => $materiales,
        ]);
        $mpdf->WriteHTML($html);

        // Agregar una nueva página
        $mpdf->AddPage();

        // Renderizar otra plantilla Twig y agregarla a la segunda página
        $htmlSecondPage = $this->renderView('inspector/reporteFotografico.html.twig', [
            'levantamiento' => $levantamiento,
        ]);
        $mpdf->WriteHTML($htmlSecondPage);

        // Enviar el PDF como respuesta
        return new Response($mpdf->Output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=archivo.pdf',
        ]);
    }


    private function base64_to_png(string $base64_string, $output_file) 
    {
        $ifp = fopen($this->getParameter('app.upload_firmas')."/".$output_file, 'wb' ); 
        $data = explode( ',', $base64_string );
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
        fclose( $ifp ); 
        return $output_file; 
    }
    
}
