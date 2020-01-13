<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Entity\Owner;
use App\Entity\Task;
use App\Entity\Todo;
use App\Repository\TaskRepository;
use App\Repository\TodoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $repository;
    private $todorep;

    /**
     * HomeController constructor.
     * @param TaskRepository $repository
     * @param TodoRepository $todorepository
     */
    public function __construct(TaskRepository $repository, TodoRepository $todorepository)
    {
        $this->repository = $repository;
        $this->todorep=$todorepository;
    }

    /**
     * @Route("/api/home", methods={"GET","HEAD"})
     * @param TaskRepository $rep
     * @param TodoRepository $todorep
     * @return Response
     */
    public function index(TaskRepository $rep, TodoRepository $todorep)
    {
        $encoders = array( new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $task = $rep->findAllTask(true);
        $Todo = $todorep->findAllTodos();
        $tasks = $rep->findOneTask(true);//get the undone task

// Serialize your object in Json
        $jsonObject = $serializer->serialize($task, 'json', [
            'circular_reference_handler' => function ($tasks) {
                return $tasks->get;
            }
        ]);

// For instance, return a Response with encoded Json
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/api/create_task", methods={"GET","HEAD"})
     * @param string $Name
     * @param string $Description
     * @return Task
     */
    private function create_Task( String $Name, String $Description): Task
    {
        $task = new Task();
        $task=$task->setDescription($Description);
        $task=$task->setName($Name);
        return $task;
    }
}
