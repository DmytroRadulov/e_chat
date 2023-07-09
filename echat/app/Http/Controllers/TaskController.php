<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'priority' => 'required|integer',
        ]);

        $task = Task::create($validatedData);

        return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
    }

    public function index(Request $request)
    {
        $sortField = $request->query('sort_field', 'created_at');
        $tasks = Task::orderBy($sortField)->get();

        return response()->json(['tasks' => $tasks], 200);
    }
}
