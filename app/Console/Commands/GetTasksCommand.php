<?php

namespace App\Console\Commands;

use App\Services\TaskProviderService;
use Illuminate\Console\Command;

class GetTasksCommand extends Command
{
    protected $signature = 'get:tasks';

    protected $description = 'Fetch tasks from providers';
    private TaskProviderService $taskService;

    /**
     * @param TaskProviderService $taskService
     */
    public function __construct(TaskProviderService $taskService)
    {
        parent::__construct();
        $this->taskService = $taskService;
    }

    public function handle(): void
    {
        $this->taskService->getTasks();
    }
}
