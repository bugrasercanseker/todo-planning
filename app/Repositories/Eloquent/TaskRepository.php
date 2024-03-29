<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Interfaces\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{

    public function getAll(): Collection
    {
        return Task::all();
    }

    public function updateOrCreate($task): void
    {
        Task::updateOrCreate(['name' => $task['name']], $task);
    }
}
