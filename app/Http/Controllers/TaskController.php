<?php

// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        // Fetch tasks from the database
        $tasks = Task::all();

        // Pass tasks to the view
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        // Show the form to create a new task
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'taskname' => 'required|string',
            'beginDate' => 'required|date',
            'endDate' => 'required|date',
            // Add any other validation rules you need
        ]);

        // Create a new task
        Task::create([
            'taskname' => $request->input('taskname'),
            'beginDate' => $request->input('beginDate'),
            'endDate' => $request->input('endDate'),
            // Add any other fields you have in the 'tasks' table
        ]);

        // Redirect to the tasks index page
        return redirect()->route('tasks.index');
    }
}

