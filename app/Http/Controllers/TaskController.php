<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use \Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * @var TaskService $taskService
     */
    protected $taskService;


    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
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
}
