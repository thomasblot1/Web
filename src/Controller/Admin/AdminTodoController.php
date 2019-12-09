<?php
namespace App\Controller\Admin;
use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTodoController extends AbstractController
{
    private $represitory;
    private $em;
    public function __construct(TodoRepository $rep, ObjectManager $Om)
    {
        $this->em=$Om;
        $this->represitory=$rep;
    }

    /**
     * @Route("/admin", name="admin.todo.index")
     * @return Response
     */
    public function index(){
        $tasks=$this->represitory->findAll();

        return($this->render('admin/todo/index.html.twig',['task'=>$tasks]));
    }

    /**
     * @Route("/admin/task/{id}", name= "admin.todo.edit")
     * @param Todo $todo
     * @param Request $request
     * @return Response
     */
    public function edit(Todo $todo, Request $request){
        $form=$this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('admin.task.index');
        }

        return $this->render("admin/task/edit.html.twig", [
            'task'=>$todo,
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("/admin/task/create", name="admin.todo.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request){
        $todo=new Todo();
        $form=$this->createForm(TodoType::class,$todo);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($todo);
            $this->em->flush();
            return $this->redirectToRoute('admin.todo.index');
        }
        return $this->render("admin/todo/new.html.twig", [
            'task'=>$task,
            'form'=>$form->createView()
        ]);

    }



}