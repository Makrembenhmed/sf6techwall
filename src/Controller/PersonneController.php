<?php

namespace App\Controller;

use App\Entity\Personne;

use Doctrine\Persistence\ManagerRegistry;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('personne')]
class PersonneController extends AbstractController
{

    #[Route('/', name: 'personne.list')]
    public  Function index(ManagerRegistry $doctrine): Response
    {
    $reposetry= $doctrine->getRepository(Personne::class);
    $personnes = $reposetry->findAll();
        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }


    #[Route('/alls/{page?1}/{nbre?12}', name: 'personne.list.all')]
    public  Function indexAll(ManagerRegistry $doctrine,$page,$nbre): Response
    {
        $reposetry= $doctrine->getRepository(Personne::class);
        $personnes = $reposetry->findBy([],[],$nbre,($page-1)*$nbre);
        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }


    #[Route('/{id<\d+>}', name: 'personne.detail')]
    public  Function detail(ManagerRegistry $doctrine,$id): Response
    {
        $reposetry= $doctrine->getRepository(Personne::class);
        $personne = $reposetry->find($id);
        if(!$personne) {
        $this->addFlash('error',"la personne d id $id nexiste pas ");
        return $this->redirectToRoute('personne.list');
        }
            return $this->render('personne/detail.html.twig', [
                'personne' => $personne,
            ]);


    }

    #[Route('/add', name: 'app.personne')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {

        // $this->getDoctrine () version< 5
        $entityManager =$doctrine->getManager();
        $personne=new Personne();
        $personne->setName('makrem');
        $personne->setFirstName('ben hhhh');
        $personne->setAge('5');
        $personne->setJob('developpeur');
        // ajouter l operation d ajout personne a la transaction
        $entityManager->persist($personne);
        // execute la transaction
        $entityManager->flush();

        return $this->render('personne/detail.html.twig', [
            'personne' => $personne,
        ]);
    }
    #[Route('/delete/{id}', name: 'personne.delete')]
    public function removePersonne(ManagerRegistry $doctrine,$id): RedirectResponse{
        $reposetory=$doctrine->getRepository(Personne::class);
        $personne=$reposetory->find($id);

    
        if($personne){
            $manager = $doctrine->getManager();
            $manager->remove($personne);
            $manager->flush();
            $this->addFlash('success','personne supprmùer avec succes');
            
        }else{
            $this->addFlash('error','personne inexistatnt');
        }
        return $this->redirectToRoute('personne.list');

        }
        #[Route('/update/{id}/{name}/{firstName}/{age}', name:'personne.update')]
        public function editPersonne(ManagerRegistry $doctrine,$name,$firstName,$age,$id): Response{
            $reposetory=$doctrine->getRepository(Personne::class);
            $personne=$reposetory->find($id);

            if($personne){
                $personne->setName($name);
                $personne->setFirstName($firstName);
                $personne->setAge($age);
                $entityManager = $doctrine->getManager();
                $entityManager->persist($personne);
                $entityManager->flush();
                $this->addFlash('success','personne modifié avec succes');
            }else{
                $this->addFlash('error','personne inexistatnt');
            }

            return $this->redirectToRoute('personne.list');
        }
}
