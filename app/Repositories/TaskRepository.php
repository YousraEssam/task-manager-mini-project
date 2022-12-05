<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
}
