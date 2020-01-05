<?php
namespace App\Controller\Admin;
use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoRepository;
use Doctrine\Common\Persistence\ObjectManager;
use PhpParser\Node\Scalar\String_;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
     * @Route("api/todo/delete/{Name}", name="todo.delete")
     * @param $Name
     * @return Response
     */
    public function deleteTodo($Name){
        // from inside a controller
        $repository = $this->getDoctrine()->getRepository(Todo::class);
        $todo = $repository->findByName($Name);
        $this->em->remove($todo);
        $this->em->flush();
        return new Response( '',200);
    }

    /**
     * @Route("api/todo/getTodos", name="todo.getTodos")
     * @return Response
     */
    public function getTodos(){
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $todos=$this->represitory->findAll();
        $jsonObject = $serializer->serialize($todos, 'json', [
            'circular_reference_handler' => function ($todos) {
                return $todos->get;
            }]);
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }


    /**
     * @Route("api/todo/getTodo/{Name}", name="admin.todo.getTodos")
     * @return Response
     */
    public function getTodo($Name){
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);



        $todo=$this->represitory->findByName($Name);
        if ($todo == '404') {
            throw $this->createNotFoundException(
                'No todo found for name '.$Name
            );
        }
        $jsonObject = $serializer->serialize($todo, 'json', [
            'circular_reference_handler' => function ($todo) {
                return $todo->get;
            }]);
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/api/todo/update/{id}")
     * @param $Name
     * @return Response
     */
    public function update($Name)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $todo = $this->represitory->findByName($Name);
        if ($todo == '404') {
            throw $this->createNotFoundException(
                'No todo found for name '.$Name
            );
        }
        $todo->setName($Name);
        $entityManager->flush();
        return new Response('', 200);
    }


    /**
     * @Route("/admin/todo/create", name="admin.todo.new")
     * @param $Name
     * @return Response
     */
    public function new($Name){
        $todo = new Todo();
        $todo->setName($Name);
        $this->em->persist($todo);
        $this->em->flush();

        return new Response('', 200);
    }
}
