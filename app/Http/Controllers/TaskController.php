<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->get();
        return response()->json(['tasks' => $tasks], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
       
        $user = $request->user();
        $task = $user->tasks()->create($request->validated());
        return response()->json(['task' => $task], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        $task = Task::find($task->id);
        return response()->json(['task' => $task], 200);
    }

    /**
     * Mark the specified task as completed or not completed.
     */
    public function completeTask(Task $task)
    {
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
        return response()->json(['task' => $task], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
    }

    protected function validateTask(Task $task)
    {
        return request()->validate([
            'name' => 'required|string|max:255',
            'is_completed' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
        ]);
    }
}
