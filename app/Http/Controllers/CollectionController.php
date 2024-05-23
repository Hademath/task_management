<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Task;

class CollectionController extends Controller
{
     public function index(Request $request)
    {
        return $request->user()->collections()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $collection = Collection::create($validated);
        $request->user()->collections()->attach($collection->id);
        return $collection;
    }

    public function show($id)
    {
        $collection = Collection::find($id);
        if (!$collection) {
                return response()->json(['message' => 'Collection not found'], 404);
        }
        $collection = Collection::with('tasks')->find($id);
        $this->authorize('view', $collection);
 
        return response()->json($collection);
    }

    public function update(Request $request,  $id)
    {
        $collection = Collection::find($id);
        $collection = Collection::find($id);
        if (!$collection) {
            return response()->json(['message' => 'Collection not found'], 404);
        }
        $this->authorize('update', $collection);
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $collection->update($validated);
        return $collection;
    }

    public function destroy($id)
    {

        try {
            $collection = Collection::find($id);
            if (!$collection) {
                return response()->json(['message' => 'Collection not found'], 404);
            }
            $this->authorize('delete', $collection);
            $collection->delete();
            return response()->json(['message' => 'Deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}
