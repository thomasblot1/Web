<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Todo1Controller extends AbstractController
{

    private $Taskrep;

    public function __construct(TaskRepository $Taskreprository)
    {
        $this->Taskrep=$Taskreprository;
    }

    /**
     * @Route("/todo1", name="todo1")
     */
    public function index()
    {
        $alltask=$this->Taskrep->findAll();

        return $this->render('todo1/index.html.twig', [
            compact($alltask)
        ]);
    }
}
