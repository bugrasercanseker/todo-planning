<?php

namespace App\Interfaces;

interface TaskRepositoryInterface
{
    public function updateOrCreate($task): void;
}
