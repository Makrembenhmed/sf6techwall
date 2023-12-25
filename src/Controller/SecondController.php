<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecondController extends AbstractController
{
    #[Route('/2', name: 'app_second')]
    public function index(): Response
    {
        return new Response(
            "<html>
                <head>
                    <title>fdqsfqsfgqsfqsgf</title> 
                </head>
                <body>
                    <h1>Makrem</h1>
                </body>
            </html>"
        );
    }
}


