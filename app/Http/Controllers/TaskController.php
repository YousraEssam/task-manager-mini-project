<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use App\Services\UserService;
use \Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * @var TaskService $taskService
     */
    protected $taskService;

    /**
     * @var UserService $userService
     */
    protected $userService;

    public function __construct(TaskService $taskService, UserService $userService)
    {
        $this->taskService = $taskService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the tasks.
     *
     * @return View
     */
    public function index(): View
    {
        $tasks = $this->taskService->getTaskList();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return View
     */
    public function create(): View
    {
        $users = $this->userService->getUsers();

        return view('tasks.create', [
            'adminUsers' => $users['adminUsers'],
            'nonAdminUsers' => $users['nonAdminUsers']
        ]);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  TaskRequest  $request
     * @return RedirectResponse
     */
    public function store(TaskRequest $request): RedirectResponse
    {
        $task = $this->taskService->createNewTask($request->all());

        return redirect()->route('tasks.index')->with('success','Task #'.$task->id.' created successfully.');
    }
}
