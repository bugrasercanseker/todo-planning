<?php

namespace App\Services;

use App\Repositories\Eloquent\TaskRepository;

class TaskService
{
    private TaskRepository $repository;

    /**
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateOrCreate(array $task): void
    {
        $this->repository->updateOrCreate(task: $task);
    }
}
