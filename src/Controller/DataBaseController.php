<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataBaseController extends AbstractController
{
    #[Route('/data/base', name: 'app_data_base')]
    public function index(): Response
    {


        return $this->render('data_base/index.html.twig', [
            'controller_name' => 'DataBaseController',
            'test' => 7
        ]);
    }
}
