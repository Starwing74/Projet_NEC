<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        $home_about_list = [
            [
                'color' => 'var(--secondary-color)',
                'picture' => './images/pages/about/intro/plan.svg',
                'text' => "Maîtrise d'œuvre complète \nou spécialisée \nen tant que mandataire \nou co-traitant",
            ],
            [
                'color' => 'var(--tertiary-color)',
                'picture' => './images/pages/about/intro/engineering.svg',
                'text' => "Ingénierie \ntraditionnelle",
            ],
        ];

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'test' => 1,
            'home_about_list' => $home_about_list
        ]);
    }
}
