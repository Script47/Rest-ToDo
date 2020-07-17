<?php

namespace App\Service;

use App\Entity\Task;
use App\Repository\TaskRepository;

/**
 * Class TaskService
 * @package App\Service
 */
class TaskService
{
    /**
     * @var TaskRepository
     */
    private TaskRepository $taskRepository;

    /**
     * TaskService constructor.
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->taskRepository->findAll();
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function create(Task $task): bool
    {
        return $this->taskRepository->save($task);
    }
}
