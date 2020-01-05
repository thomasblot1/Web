<?php
namespace App\Controller\Admin;
use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @Route("/api/task/getTasks", name="admin.task.index")
     * @Method({"GET","POST"})
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
     * @Route("/api/task/getTask/{Name}", name="admin.task.index.id")
     * @Method({"GET","POST"})
     * @return Response
     */
    public function getTask($Name){
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $task=$this->represitory->findByName($Name);

        $jsonObject = $serializer->serialize($task, 'json', [
            'circular_reference_handler' => function ($task) {
                return $task->get;
            }
        ]);

        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/api/task/create", name="admin.task.new")
     * @Method({"GET"})
     * @param $Todo
     * @param $Name
     * @param $Description
     * @param $Priority
     * @return Response
     */
    public function add($Todo, $Name, $Description, $Priority){
        $task = new task();
        $task->affect($Todo, $Name, $Description, $Priority);
        $this->em->persist($task);
        $this->em->flush();
        return new Response('', 200);
    }

    /**
     * @Route("api/task/delete/{Name}", name="task.delete")
     * @Method({"PUT"})
     * @param $Name
     * @return Response
     */
    public function deleteTask($Name){
        $repository = $this->getDoctrine()->getRepository(Task::class);
        $task = $repository->findByName($Name);
        $this->em->remove($task);
        $this->em->flush();
        return new Response( '',200);
    }

    /**
     * @Route("/api/task/edit/{Name}")
     * @param $Todo
     * @param $Name
     * @Method({"PUT"})
     * @param $Description
     * @param $Priority
     */
    public function update($Todo, $Name, $Description, $Priority)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $task = $this->represitory->findByName($Name);
        if (!$task) {
            throw $this->createNotFoundException(
                'No task found for name '.$Name
            );
        }
        $task->setName($Name);
        $task->setDescription($Description);
        $task->setPriority($Priority);
        $task->setTodo($Todo);
        $task->setDate();
        $entityManager->flush();
    }

}
