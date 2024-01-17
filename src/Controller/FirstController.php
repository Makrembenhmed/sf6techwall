<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {

       return new Response(
            "<head>

                    </head>
                    <body> <h1>fghfdddddddddddddddddd</h1></body>"

        );

    }

    #[Route('/first/template', name: 'app_template')]
    public function template(): Response
    {

        return $this->render('template.html.twig');

    }
}
