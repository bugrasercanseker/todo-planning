<?php

namespace App\Strategies\Task;

use App\Interfaces\StrategyInterface;
use App\Models\Developer;
use App\Models\Task;

class WorkloadBalancingStrategy implements StrategyInterface
{
    /**
     * Assign tasks to developers based on workload balancing strategy.
     *
     * @param Developer[] $developers Array of Developer objects
     * @param Task[] $tasks Array of Task objects
     * @return array Array of Developer objects with assigned tasks
     */
    public function assignTasks(array $developers, array $tasks): array
    {
        // Calculate workload for each developer and task
        $developers = collect($developers)->map(function (array $developer) {
            $developer['workload'] = $developer['level'] * $developer['working_hours'];
            $developer['weeks'] = [];
            return $developer;
        })->toArray();

        $tasks = collect($tasks)->map(function (array $task) {
            $task['workload'] = $task['level'] * $task['estimated_duration'];
            return $task;
        })->toArray();

        // Assign tasks to developers week by week
        $weekIndex = 0;
        while (count($tasks) !== 0) {
            $data = $this->handleByWeek(weekIndex: $weekIndex, developers: $developers, tasks: $tasks, rollover: false);
            $tasks = $data['tasks'];
            $developers = $data['developers'];
            $weekIndex++;
        }

        return $developers;
    }

    /**
     * Handle task assignment for a specific week.
     *
     * @param int $weekIndex Index of the week
     * @param array $developers Array of Developer objects
     * @param array $tasks Array of Task objects
     * @return array Array containing remaining tasks and developers with updated assignments
     */
    private function handleByWeek(int $weekIndex, array $developers, array $tasks, bool $rollover): array
    {
        // Termination condition: If there are no tasks, return early
        if (empty($tasks)) {
            return ['tasks' => [], 'developers' => $developers];
        }

        foreach ($developers as &$developer) {
            // Initialize week for developer if not exists
            if (!array_key_exists($weekIndex, $developer['weeks'])) {
                $developer['weeks'][$weekIndex] = ['tasks' => [], 'workload' => 0];
            }

            $week = &$developer['weeks'][$weekIndex];

            foreach ($tasks as $taskIndex => $task) {
                $remainWorkload = $developer['workload'] - $week['workload'];

                if ($remainWorkload === 0) {
                    break;
                }

                // Assign task to developer
                $developer = $this->assignTaskToDeveloper(developer: $developer, task: $task, remainWorkload: $remainWorkload, weekIndex: $weekIndex, rollover: $rollover);

                // Remove assigned task from the tasks array
                unset($tasks[$taskIndex]);
            }
        }

        return ['tasks' => $tasks, 'developers' => $developers];
    }

    /**
     * Assigns a task to a developer for a specific week, considering the remaining workload and rollover tasks.
     *
     * @param array $developer The developer to assign the task to
     * @param array $task The task to assign
     * @param int $remainWorkload The remaining workload capacity of the developer for the week
     * @param int $weekIndex The index of the week to assign the task to
     * @param bool $rollover Indicates whether the task is a rollover task from the previous week
     * @return array The updated developer array with the assigned task
     */
    private function assignTaskToDeveloper(array $developer, array $task, int $remainWorkload, int $weekIndex, bool $rollover = false): array
    {
        // Initialize week for developer if it does not exist
        if (!array_key_exists($weekIndex, $developer['weeks'])) {
            $developer['weeks'][$weekIndex] = ['tasks' => [], 'workload' => 0];
        }

        $week = &$developer['weeks'][$weekIndex];

        if ($task['workload'] <= $remainWorkload) {
            // Create a copy of the task array
            $newTask = $task;
            $newTask['rollover'] = $rollover;
            // Add the modified task to the week's tasks
            $week['tasks'][] = $newTask;
            $week['workload'] += $newTask['workload'];
        } else {
            // Split Task
            $task['rollover'] = true;

            // Create Remain Fill Task to fill the week's workload capacity
            $taskRemainFill = $task;
            $taskRemainFill['workload'] = $remainWorkload;
            $week['tasks'][] = $taskRemainFill;
            $week['workload'] += $taskRemainFill['workload'];

            // Create Remain Task for the next week
            $taskRemain = $task;
            $taskRemain['workload'] = $task['workload'] - $remainWorkload;

            // Recursively handle the remaining task for the next week using a copy of the tasks
            $developer = $this->assignTaskToDeveloper($developer, $taskRemain, $developer['workload'], $weekIndex + 1, $rollover);
        }

        return $developer;
    }
}
