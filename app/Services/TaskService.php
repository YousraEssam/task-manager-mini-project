<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService
{
    /**
     * @var TaskRepository $taskRepo
     */
    protected $taskRepo;

    public function __construct(TaskRepository $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    /**
     * Get task list.
     *
     * @return LengthAwarePaginator
     */
    public function getTaskList(): LengthAwarePaginator
    {
        return $this->taskRepo->getTaskList();
    }
}
