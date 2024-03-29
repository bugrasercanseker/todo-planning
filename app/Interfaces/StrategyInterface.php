<?php

namespace App\Interfaces;

use App\Models\Developer;
use App\Models\Task;

interface StrategyInterface
{
    /**
     * @param Developer[] $developers
     * @param Task[] $tasks
     * @return array
     */
    public function assignTasks(array $developers, array $tasks): array;
}
