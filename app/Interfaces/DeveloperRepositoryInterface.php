<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface DeveloperRepositoryInterface
{
    public function getAll(): Collection;
    public function updateOrCreate(array $developer): void;
}
