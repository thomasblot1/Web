<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\Todo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Boolean;
use PhpParser\Node\Scalar\String_;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @param bool $state
     * @return mixed
     */
    public function findAllTask(Bool $state)
    {
        return $this->createQueryBuilder('All_Tasks')

            ->where('All_Tasks.State='.(String)$state)
            ->orderBy('All_Tasks.id')
            ->getQuery()
            ->getResult()
            ;
    }
    /**
    * @param bool $state
    * @return mixed
    */
    public function findOneTask(Bool $state)
    {
        return $this->createQueryBuilder('All_Tasks')

            ->where('All_Tasks.State='.(String)$state)
            ->orderBy('All_Tasks.id')
            ->getQuery()
            ->getResult(1);
    }
    // /**
    //  * @return Task[] Returns an array of Task objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Task
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByID(int $taskid)
    {
        return $this->createQueryBuilder('t')
            ->setParameter('id', $taskid)
            ->getQuery()
            ->getResult()
            ;
    }
    public function deleteTask(Task $task){
        $qb = $this->createQueryBuilder('t');
        $qb->delete('Task', 't');
        $qb->where('t.Name = '.$task.'');
    }

}
