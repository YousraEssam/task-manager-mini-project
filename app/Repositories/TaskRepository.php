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
}
