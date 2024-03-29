<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeritageController extends AbstractController
{
    #[Route('/twig', name: 'twig_heritage')]
    public function index(): Response
    {
        return $this->render('heritage/index.html.twig', [
            'controller_name' => 'HeritageController',
        ]);
    }


    #[Route('/twig/heritage', name: 'heritage')]
    public function heritage(): Response
    {
        return $this->render('heritage/heritage.html.twig');
    }
}
