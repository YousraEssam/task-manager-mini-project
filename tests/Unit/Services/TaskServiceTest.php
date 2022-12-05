<?php

namespace Tests\Unit\Services;

use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use PDOException;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{
    /**
     * @var TaskService
     */
    protected $taskService;

    /**
     * @var User
     */
    protected $adminUser;

    /**
     * @var User
     */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->taskService = new TaskService(new TaskRepository());
        $this->adminUser = $this->createUser(true);
        $this->user = $this->createUser();
    }

    public function test_that_create_task_succeeds()
    {
        $task = $this->taskService->createNewTask([
            'assigned_by_id' => $this->adminUser->id,
            'title' => 'test title',
            'description' => 'test desc',
            'assigned_to_id' => $this->user->id
        ]);

        $this->assertInstanceOf(Task::class, $task);
        $this->assertIsObject($task);
        $this->assertEquals('test title', $task->title);
        $this->assertEquals('test desc', $task->description);
        $this->assertEquals($this->adminUser->id, $task->assigned_by_id);
        $this->assertEquals($this->user->id, $task->assigned_to_id);
    }

    public function test_that_create_task_fails_if_missing_assigned_by_id()
    {
        $this->expectException(QueryException::class);
        $this->expectException(PDOException::class);

        $this->taskService->createNewTask([
            'title' => 'test title',
            'description' => 'test desc',
            'assigned_to_id' => $this->user->id
        ]);
    }

    public function test_that_create_task_fails_if_missing_title()
    {
        $this->expectException(QueryException::class);
        $this->expectException(PDOException::class);

        $this->taskService->createNewTask([
            'assigned_by_id' => $this->adminUser->id,
            'description' => 'test desc',
            'assigned_to_id' => $this->user->id
        ]);
    }

    public function test_that_create_task_fails_if_missing_description()
    {
        $this->expectException(QueryException::class);
        $this->expectException(PDOException::class);

        $this->taskService->createNewTask([
            'assigned_by_id' => $this->adminUser->id,
            'title' => 'test title',
            'assigned_to_id' => $this->user->id
        ]);
    }

    public function test_that_create_task_fails_if_missing_assigned_to_id()
    {
        $this->expectException(QueryException::class);
        $this->expectException(PDOException::class);

        $this->taskService->createNewTask([
            'assigned_by_id' => $this->adminUser->id,
            'title' => 'test title',
            'description' => 'test desc',
        ]);
    }

    public function test_that_get_task_list_return_paginated_tasks()
    {
        $this->createTask(5);

        $tasks = $this->taskService->getTaskList();

        $this->assertEquals(5, $tasks->total());
        $this->assertInstanceOf(LengthAwarePaginator::class, $tasks);
    }

    public function test_that_get_task_list_return_empty_list_if_no_tasks_found()
    {
        $tasks = $this->taskService->getTaskList();

        $this->assertEquals(0, $tasks->total());
        $this->assertInstanceOf(LengthAwarePaginator::class, $tasks);
    }

    public function test_that_get_statistics()
    {
        $this->createTask(2);
        $tasks = $this->taskService->getStatistics();

        $this->assertEquals(1, $tasks->count());
        $this->assertEquals(2, $tasks[0]->task_count);
    }

    public function test_that_get_statistics_return_empty_list_if_no_tasks_found()
    {
        $tasks = $this->taskService->getStatistics();

        $this->assertEquals(0, $tasks->count());
    }

    /**
     * @param bool $isAdmin
     * @return User|null
     */
    private function createUser(bool $isAdmin = false): ?User
    {
        return User::factory()->create(['is_admin' => $isAdmin]);
    }

    /**
     * @param int $count
     * @return Collection
     */
    private function createTask(int $count = 1): Collection
    {
        return Task::factory($count)->create([
            'assigned_by_id' => $this->adminUser->id,
            'assigned_to_id' => $this->user->id
        ]);
    }
}
