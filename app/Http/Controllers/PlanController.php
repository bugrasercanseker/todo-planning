<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Task;
use App\Services\DeveloperService;
use App\Services\TaskService;
use App\Strategies\Task\WorkloadBalancingStrategy;

class PlanController extends Controller
{
    private WorkloadBalancingStrategy $strategy;
    private TaskService $taskService;
    private DeveloperService $developerService;

    /**
     * @param WorkloadBalancingStrategy $strategy
     * @param TaskService $taskService
     * @param DeveloperService $developerService
     */
    public function __construct(WorkloadBalancingStrategy $strategy, TaskService $taskService, DeveloperService $developerService)
    {
        $this->strategy = $strategy;
        $this->taskService = $taskService;
        $this->developerService = $developerService;
    }

    public function index()
    {
        $developers = $this->developerService->getAll();
        $tasks = $this->taskService->getAll();

        $plans = $this->strategy->assignTasks(developers: $developers->toArray(), tasks: $tasks->toArray());

        if (request()->get('json')) {
            return response()->json($plans);
        }
        return inertia()->render(
            'Plan/Index',
            compact('plans')
        );
    }
}
