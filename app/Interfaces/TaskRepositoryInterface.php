<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    public function getAll(): Collection;
    public function updateOrCreate(array $task): void;
}
