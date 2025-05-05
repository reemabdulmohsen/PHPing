<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Resources\TaskResource;
class TaskController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return response()->json(['tasks' => $tasks], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
       
        $user = $request->user();
        $task = $user->tasks()->create($request->validated());
        return response()->json(['task' => new TaskResource($task)]);
    }

    /**
     * Display the specified resource.
     */
    public function show($task_id)
    {
        $task = Task::find($task_id);
        $this->authorize('view', $task);
        return response()->json(['task' => new TaskResource($task)]);
    }

    /**
     * Mark the specified task as completed or not completed.
     */
    public function completeTask($task_id)
    {
        $task = Task::find($task_id);
        $this->authorize('update', $task);
        $was_completed = $task->is_completed;

        if ($was_completed) {
            $task->completed_at = null;
            $task->is_completed = false;
        } else {
            $task->completed_at = now();
            $task->is_completed = true;
        }
        $task->save();
        return response()->json(['task' => new TaskResource($task)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($task_id)
    {
        $task = Task::find($task_id);
        $this->authorize('delete', $task);
        $task->delete();
    }


}
