<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonType;
use Doctrine\Persistence\ManagerRegistry;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('personne/index.html.twig', ['personnes'=>$personnes]);
    }

    
    #[Route('/alls/age/{agemin}/{agemax}', name: 'personne.list.age')]
    public  Function personneByAge(ManagerRegistry $doctrine, $agemin, $agemax): Response
    {
    $reposetry= $doctrine->getRepository(Personne::class);
    $personnes = $reposetry->findPersonneByAgeIntervalle($agemin, $agemax);
        return $this->render('personne/index.html.twig', ['personnes'=>$personnes]);
    }


    #[Route('/stats/age/{agemin}/{agemax}', name: 'personne.age.stat')]
    public  Function statPersonneByAge(ManagerRegistry $doctrine, $agemin, $agemax): Response
    {
    $reposetry= $doctrine->getRepository(Personne::class);
    $stats = $reposetry->statPersonneByAgeIntervalle($agemin, $agemax);
   // dd($stats);
        return $this->render('personne/stats.html.twig', ['stats'=>$stats,'agemin'=>$agemin,'agemax'=>$agemax]);
    }



    #[Route('/alls/{page?1}/{nbre?12}', name: 'personne.list.all')]
    public  Function indexAll(ManagerRegistry $doctrine,$page,$nbre): Response
    {   
        $reposetry= $doctrine->getRepository(Personne::class);

        $nbrepersonne = $reposetry->count([]);
        $nbrepages=ceil( $nbrepersonne/$nbre);
        $personnes = $reposetry->findBy([],[],$nbre,($page-1)*$nbre);
     //   dd($nbrepages);
        
        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
            'isPaginated'=>true,
            'nbrepages'=>$nbrepages,
            'page'=>$page,  
            'nbre'=>$nbre,
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
    

    #[Route('/edit/{id?0}', name: 'personne.edit')]
    public function addPersonne(ManagerRegistry $doctrine,Request $request,$id): Response
    {
        
        
        $reposetory=$doctrine->getRepository(Personne::class);
        $personne=$reposetory->find( $id );
        //dd($personne);
        // $this->getDoctrine () version< 5
        $new=false;
       if(!($personne)) {
        $personne=new Personne();
        $new=true;
       }
        // $personne est limage de formulaire
        $form= $this->createForm(PersonType::class,$personne);
        $form->remove('createdAt');
        $form->remove('updatedAt');
        $form->handleRequest($request);
        // si le formul est soumis
        if ($form->isSubmitted()) {

            // si oui on va ajouter personne a la bd
            //dd($personne);
            $entityManager =$doctrine->getManager();
            $entityManager->persist($personne);
            $entityManager->flush();
            if($new) {
                $message=" ajout avec succes";
            }else{
                $message=" M A J avec succes";
            }
            $this->addFlash('success', $message );
            return $this->redirectToRoute('personne.list');
            

        }else{

            // on affiche notre formulaire
                
        return $this->render('personne/add-personne.html.twig', [
            'form'=>$form->createView(),
]);
        }


        
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
