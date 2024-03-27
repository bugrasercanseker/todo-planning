<?php

namespace App\Adapters;

use Illuminate\Support\Facades\Http;
use App\Exceptions\UnexpectedProviderResponseException;
use App\Interfaces\TaskProviderInterface;
use App\Services\TaskService;
use Illuminate\Support\Facades\Storage;

class TaskProviderOneAdapter implements TaskProviderInterface
{
    private TaskService $taskService;

    /**
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function getTasks(): void
    {
        // Mocky not working, use local json data
        /*
        $tasks = Http::get('https://run.mocky.io/v3/27b47d79-f382-4dee-b4fe-a0976ceda9cd');

        if ($tasks->failed()) {
            throw new UnexpectedProviderResponseException('Unexpected response from Provider One');
        }

        $tasks = $tasks->json();
        */

        // Get Tasks from Local Storage
        $tasks = Storage::disk('local')->json('tasks/provider_one.json');

        // Create Tasks
        foreach ($tasks as $task) {
            $this->taskService->updateOrCreate(task: $this->mapForModel(task: $task));
        }
    }

    private function mapForModel(array $task): array
    {
        return [
            'name'               => $task['id'],
            'level'              => $task['value'],
            'estimated_duration' => $task['estimated_duration'],
        ];
    }
}
