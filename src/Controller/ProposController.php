<?php

namespace App\Controller;

use App\Repository\ChronologieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProposController extends AbstractController
{
    #[Route('/propos', name: 'app_propos')]
    public function index(ChronologieRepository $chronologieRepository): Response
    {
        $list_chronologie = $chronologieRepository->findAll();

        return $this->render('propos/index.html.twig', [
            'controller_name' => 'ProposController',
            'test' => 2,
            'list_chronologie' => $list_chronologie
        ]);
    }
}
