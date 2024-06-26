<?php

namespace App\Services;

use App\Adapters\TaskProviderOneAdapter;
use App\Adapters\TaskProviderTwoAdapter;
use App\Exceptions\UnexpectedProviderResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskProviderService
{
    private array $adapters;

    public function __construct(TaskProviderOneAdapter $providerOneAdapter, TaskProviderTwoAdapter $providerTwoAdapter)
    {
        $this->adapters = [$providerOneAdapter, $providerTwoAdapter];
    }

    public function getTasks(): void
    {
        try {
            DB::beginTransaction();

            foreach ($this->adapters as $adapter) {
                $adapter->getTasks();
            }

            DB::commit();
        } catch (UnexpectedProviderResponseException $exception) {
            DB::rollBack();

            Log::error($exception->getMessage());
        }

    }
}
