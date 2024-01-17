<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Doctrine\StaticAnalysis\Tools\Pagination\test;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'name' => 'ALI',
            'firstname'=> 'ben hmed',
            'path'=>'           '
        ]);
    }


    #[Route('/hello', name: 'hello')]
    public function hello(): Response
    {
        $rand=rand(0,10);
        echo $rand;
        if ($rand % 2== 0){

            return $this ->redirectToRoute('test');
        }
        return $this->forward('App\Controller\TestController::index');
    }
    #[Route('/multiple/{nb1<\d+>}/{nb2<\d+>}',
        name: 'multiple',
       // requirements: ['nb1'=>'\d+','nb2'=>'\d+']
    )]
    public function multiplication(Request $request,$nb1,$nb2)
    {
        $nb=$nb2*$nb1;

       // return $this->render('test/index.html.twig', [
         //   'nb' => $nb,]);
        return new Response(content: "<h1>   $nb </h1>");


    }
}
