<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ConnexionController extends AbstractController
{
    #[Route('/connexion', name: 'login')]
    public function index(AuthenticationUtils $authentificationUtils, \Symfony\Component\HttpFoundation\Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($user) {
            return $this->redirectToRoute('app_accueil');
        }

        $errors = $authentificationUtils->getLastAuthenticationError();
        $lastUserName = $authentificationUtils->getLastUsername();

        if($errors) {
            $session = $request->getSession();

            $tentative = $session->get('tentative', []);

            $tentative = 5;

            $session->set('tentative',$tentative);
        }

        return $this->render('connexion/index.html.twig', ['last_username' => $lastUserName, 'error' => $errors, 'test' => 0]);
    }


    #[Route('/deconnection', name: 'logout')]
    public function logout(): Response
    {
        throw new \Exception( message: 'On ne passe pas ici');
        return $this->redirectToRoute("app_accueil");
    }
}
