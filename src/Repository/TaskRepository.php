<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class TaskRepository
 * @package App\Repository
 */
class TaskRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManager|EntityManagerInterface
     */
    private EntityManager $em;

    /**
     * TaskRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);

        $this->em = $this->getEntityManager();
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function save(Task $task): bool
    {
        try {
            $this->getEntityManager()->persist($task);
            $this->getEntityManager()->flush();

            return true;
        } catch (ORMException $e) {
            /** logging... **/
            return false;
        }
    }
}
