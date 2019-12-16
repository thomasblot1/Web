<?php
namespace App\Controller\Admin;
use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AdminTaskController extends AbstractController
{
    private $represitory;
    private $em;
    public function __construct(TaskRepository $rep, ObjectManager $Om)
    {
        $this->em=$Om;
        $this->represitory=$rep;
    }

    /**
     * @Route("/api/task/GetTasks", name="admin.task.index")
     * @return Response
     */
    public function getTasks(){
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $tasks=$this->represitory->findAll();

        $jsonObject = $serializer->serialize($tasks, 'json', [
            'circular_reference_handler' => function ($tasks) {
                return $tasks->get;
            }
        ]);

        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/api/task/{id}", name= "admin.task.edit")
     * @param Task $task
     * @param Request $request
     * @return Response
     */
    public function edit(Task $task, Request $request){
        $form=$this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('admin.task.index');
        }

        return $this->render("admin/task/edit.html.twig", [
            'task'=>$task,
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("/api/task/create", name="admin.task.new")
     * @param Request $request
     * @param $id
     * @param $Todo
     * @param $Name
     * @param $Description
     * @param $Priority
     * @param $State
     * @return Response
     */
    public function new(Request $request,$id, $Todo, $Name, $Description, $Priority, $State){
        $task = $this->getTask();
        $task->rebuild($id, $Todo, $Name, $Description, $Priority, $State);
        $this->em->persist($task);
        $this->em->flush();
        return new Response('', 200);
    }
    /**
     * @Route("/api/task/edit/{id}")
     */
    public function update(Request $request,$task)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $task = $entityManager->getRepository(Task::class)->find($id);
        if (!$task) {
            throw $this->createNotFoundException(
                'No task found for id '.$id
            );
        }
        $task->setName($task->getName());$task->setDescription($task->getDescription());$task->setPriority($task->getPriority());
        $entityManager->flush();
    }



}
