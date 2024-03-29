<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\DeveloperRepositoryInterface;
use App\Models\Developer;
use Illuminate\Database\Eloquent\Collection;

class DeveloperRepository implements DeveloperRepositoryInterface
{

    public function getAll(): Collection
    {
        return Developer::all();
    }

    public function updateOrCreate(array $developer): void
    {
        Developer::updateOrCreate(['name' => $developer['name']], $developer);
    }
}
