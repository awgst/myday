<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $task;

    public function __construct(TaskRepository $task)
    {
        $this->task = $task;
    }

    public function store(Request $request)
    {
        try {
            $task = $this->task->store(['card_id'=>$request->card_id]);
        } catch (Exception $e) {
            return panic($e);
        }

        return view('component.task', ['id'=>$task->id]);
    }
}
