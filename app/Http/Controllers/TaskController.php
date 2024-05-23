<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Task;

class TaskController extends Controller
{
     public function store(Request $request, $collection_id)
    { 
        $collection = Collection::find($collection_id);
        if (!$collection) {
            return response()->json(['message' => 'Collection not found'], 404);
        }
        $this->authorize('view', $collection);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = $collection->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return response()->json($task, 201);
    
    }

    public function update(Request $request, $collection_id, $task_id) 
    {
        $collection = Collection::find($collection_id);
        $this->authorize('view', $collection);
        $task = Task::find($task_id);
        if (!$collection) {
            return response()->json(['message' => 'Collection not found'], 404);
        }
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $task->update($validated);
        return $task;
    }

    public function destroy( $collection_id, $task_id)
    {
        
        $collection = Collection::find($collection_id);
        $this->authorize('view', $collection);
        $task = Task::find($task_id);
        if (!$collection) {
            return response()->json(['message' => 'Collection not found'], 404);
        }
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        $task->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }

    public function show($collection_id, $task_id){
         $collection = Collection::find($collection_id);
        $this->authorize('view', $collection);
        $task = Task::find($task_id);
        if (!$collection) {
            return response()->json(['message' => 'Collection not found'], 404);
        }
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return $task;
    }
}
