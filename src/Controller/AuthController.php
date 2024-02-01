<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\UsuarioRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RequestStack;

class AuthController extends AbstractController
{
    #[Route('/', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, Security $security): Response
    {
       

        // Obtener el error de autenticación si existe
        $error = $authenticationUtils->getLastAuthenticationError();

        // Define tu mensaje de error personalizado
        $customErrorMessage = 'Las credenciales introducidas son invalidas';

        // Utiliza el mensaje personalizado si hay un error
        $errorMessage = $error ? $customErrorMessage : null;

        // Último nombre de usuario introducido por el usuario
        $lastUsername = $authenticationUtils->getLastUsername();



        return $this->render('auth/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $errorMessage, // Pass the error message instead of the whole error object
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function onLogoutSuccess(): RedirectResponse
    {
        // Realiza aquí cualquier limpieza o tareas adicionales que necesites antes del cierre de sesión
        
        // Redirige a la página de inicio de sesión o a cualquier otra página que desees después del cierre de sesión
        return new RedirectResponse('/login');
    }
}
