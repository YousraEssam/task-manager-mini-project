<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * Create new task.
     *
     * @param array $data
     * @return Task|null
     */
    public function createNewTask(array $data): ?Task
    {
        return $this->taskRepo->createNewTask($data);
    }

    /**
     * Get tasks statistics.
     *
     * @return Collection
     */
    public function getStatistics(): Collection
    {
        return $this->taskRepo->getStatistics();
    }
}
