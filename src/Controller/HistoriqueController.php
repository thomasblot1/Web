<?php

namespace App\Controller;

use App\Entity\Owner;
use App\Repository\TaskRepository;
use App\Repository\TodoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueController extends AbstractController
{
    private $repository;
    private $todorep;

    /**
     * HistoriqueController constructor.
     * @param TaskRepository $repository
     * @param TodoRepository $todorepository
     */
    public function __construct(TaskRepository $repository, TodoRepository $todorepository)
    {
        $this->repository = $repository;
        $this->todorep = $todorepository;
    }

    /**
     * @Route("/historique", name="historique")
     * @param TaskRepository $rep
     * @param TodoRepository $todorep
     * @return Response
     */
    public function index(TaskRepository $rep, TodoRepository $todorep)
    {

        $Todo=$todorep->findAllTodos();
        $tasks = $rep->findAllTask(true);//get the undone task
        return $this->render('historique/index.html.twig', [
            'tasks'=>$tasks,
            'Todo'=>$Todo
        ]);
    }
}
