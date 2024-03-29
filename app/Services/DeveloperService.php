<?php

namespace App\Services;

use App\Repositories\Eloquent\DeveloperRepository;
use Illuminate\Database\Eloquent\Collection;

class DeveloperService
{
    private DeveloperRepository $repository;

    /**
     * @param DeveloperRepository $repository
     */
    public function __construct(DeveloperRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function updateOrCreate(array $developer): void
    {
        $this->repository->updateOrCreate(developer: $developer);
    }
}
