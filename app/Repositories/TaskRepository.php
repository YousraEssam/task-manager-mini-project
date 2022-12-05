<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TaskRepository
{
    /**
     * Get task list query.
     *
     * @return LengthAwarePaginator
     */
    public function getTaskList(): LengthAwarePaginator
    {
        return Task::with(['assignedByUser', 'assignedToUser'])->orderBy('id', 'desc')->paginate(10);
    }

    /**
     * Create new task.

     * @param array $data
     * @return Task|null
     */
    public function createNewTask(array $data): ?Task
    {
        return Task::create($data);
    }

    /**
     * Get tasks statistics query.
     *
     * @return Collection
     */
    public function getStatistics(): Collection
    {
        return Task::with('assignedToUser')
            ->select(DB::raw('count(assigned_to_id) as task_count, assigned_to_id'))
            ->groupBy('assigned_to_id')
            ->orderBy('task_count', 'desc')
            ->orderBy('assigned_to_id', 'desc')
            ->limit(10)
            ->get();
    }
}
