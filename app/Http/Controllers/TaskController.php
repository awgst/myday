<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $task;

    public function __construct(TaskRepository $task)
    {
        $this->task = $task;
    }
}
