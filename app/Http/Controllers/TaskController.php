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
            return panic($e->getMessage());
        }

        return view('component.task', ['id'=>$task->id]);
    }

    public function update(Request $request, $id)
    {
        try {
            $task = $this->task->update($id, $request->all());
        } catch (Exception $e) {
            return panic($e->getMessage());
        }

        return response()->json(['task'=>$task], 200);
    }

    public function destroy($id)
    {
        try {
            $task = $this->task->destroy($id);
        } catch (Exception $e) {
            return panic($e->getMessage());
        }

        return response()->json(['task'=>$task], 200);
    }

    public function ordering(Request $request)
    {
        try {
            $this->task->ordering($request->all()['data'], 'tasks');
        } catch (Exception $e) {
            return panic($e->getMessage());
        }

        return response()->json(['message'=>'Success'], 200);
    }
}
