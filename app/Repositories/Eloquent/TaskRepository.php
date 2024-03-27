<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{

    public function updateOrCreate($task): void
    {
        Task::updateOrCreate(['name' => $task['name']], $task);
    }
}
