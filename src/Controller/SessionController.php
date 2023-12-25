<?php

namespace App\Controller;

use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $session=$request->getSession();


        if($session->has('nbvisite')){

            $nbrevisite=$session->get('nbvisite')+1;



        }else{
            $nbrevisite =1;

        }
        $session->set('nbvisite',$nbrevisite);
        return $this->render('session/index.html.twig',['nbrevisite'=>$nbrevisite]);
    }
}
