<?php

namespace App\Repository;

use App\Entity\Owner;
use App\Entity\Todo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Component\Validator\Tests\Fixtures\ToString;

/**
 * @method Todo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Todo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Todo[]    findAll()
 * @method Todo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TodoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todo::class);
    }


    /**
     * @param Owner $user
     * @return Todo[] Returns an array of Todo objects
     */

    public function findAllTodo(Owner $user)
    {
        return $this->createQueryBuilder('All_Todo')
            ->andWhere('All_Todo.id ='.(String)$user->getId())
            ->getQuery()
            ->getResult();
    }
    /**
     * @return Todo[] Returns an array of Todo objects
     */

    public function findAllTodos()
    {
        return $this->createQueryBuilder('All_Todo')
            ->orderBy('All_Todo.id')
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Todo
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
