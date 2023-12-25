<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver;
use Symfony\Component\Routing\Annotation\Route;
use function Webmozart\Assert\Tests\StaticAnalysis\integer;
#[Route('/todo')]
class TodoController extends AbstractController
{
    #[Route('/', name: 'todo')]
    public function index(Request $request): Response
    {
        $session =$request->getSession();

        // afficher tablau de todos
        // si j ai un tableau de todo je l 'affiche
        // sinon je l inialise puis je l affiche


        if (!($session->has('todos'))) {
            $todos=[
                'achat'=>'acheter cle usb',
                'cours'=>'finaliser mon cours',
                'correction'=>'corriger mes examin'
            ];

           // $this->addFlash('info',"la liste des todos viens d etre initialiser");
            $session->set('todos',$todos);

        }



        return $this->render('todo/index.html.twig');
    }
    #[Route('/home/{name}/{lastname}', name: 'home')]
    public function home(Request $request , $name , $lastname): Response
    {

    $sess=$request->getSession();
    if (!$sess->has('user_id')){
    $user_id='user1';

    } else {
    $user_id = $sess->get('user_id');
    }
        $sess->set('user_id',$user_id);

        return $this->render('first/hello.html.twig',[
            'nom'=>$name,
            'prenom'=>$lastname,
            'user_id' => $user_id
        ]);
    }

    #[Route('/add/{name?test}/{content?test}',
        name: 'todo.add',
  //  defaults: ['content'=>'default contenus']
    )]
    public function addTodo(Request $request, $name, $content): RedirectResponse
    {
        $session = $request->getSession();

        // Verify if we have a todos array in the session
        if ($session->has('todos')) {
            $todos = $session->get('todos');

            // Check if the todo with the given name already exists
            if (isset($todos[$name])) {
                $this->addFlash('error', "The todo with ID $name already exists in the list");
            } else  {
                // Add the new todo
                $todos[$name] = $content;

                $session->set('todos',$todos);
                $this->addFlash('success', "The todo with ID $name has been successfully added");
                dump($session);
            }
        } else {
            $this->addFlash('error', "The list of todos has not been initialized yet");
        }

        // Redirect to the 'todo' route after processing
        return $this->redirectToRoute('todo');
    }

    // update todo


    #[Route('/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content): RedirectResponse
    {
        $session = $request->getSession();

        // Verify if we have a todos array in the session
        if ($session->has('todos')) {
            $todos = $session->get('todos');

            // Check if the todo with the given name already exists
            if (!isset($todos[$name])) {
                $this->addFlash('error', "The todo with ID $name n exists pas in  the list");
            } else  {
                // Add the new todo
                $todos[$name] = $content;

                $session->set('todos',$todos);
                $this->addFlash('success', "The todo with ID $name has been successfully updated");
                dump($session);
            }
        } else {
            $this->addFlash('error', "The list of todos has not been initialized yet");
        }

        // Redirect to the 'todo' route after processing
        return $this->redirectToRoute('todo');
    }

    // delete todo

    #[Route('/delete/{name}', name: 'todo.delete')]
    public function deleteTodo(Request $request, $name): RedirectResponse
    {
        $session = $request->getSession();

        // Verify if we have a todos array in the session
        if ($session->has('todos')) {
            $todos = $session->get('todos');

            // Check if the todo with the given name already exists
            if (!isset($todos[$name])) {
                $this->addFlash('error', "The todo with ID $name n exists pas in  the list");
            } else  {
                // delete the new todo
                unset($todos[$name]);


                $session->set('todos',$todos);
                $this->addFlash('success', "The todo with ID $name has been successfully updated");
                dump($session);
            }
        } else {
            $this->addFlash('error', "The list of todos has not been initialized yet");
        }

        // Redirect to the 'todo' route after processing
        return $this->redirectToRoute('todo');
    }
    #[Route('/reset', name: 'todo.reset')]
    public function resetTodo(Request $request): RedirectResponse
    {
        $session = $request->getSession();
        $session->remove('todos');

        // Verify if we have a todos array in the session
        // Redirect to the 'todo' route after processing
        return $this->redirectToRoute('todo');
    }
}
