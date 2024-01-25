<?php
// app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'taskname' => 'required|string|max:255',
            'beginDate' => 'required|date',
            'endDate' => 'required|date|after:beginDate',
        ]);

        // Assuming you are using authentication and the user is logged in
        $userId = auth()->user()->id;

        Task::create([
            'userId' => $userId,
            'taskname' => $request->input('taskname'),
            'beginDate' => $request->input('beginDate'),
            'endDate' => $request->input('endDate'),
        ]);

        return redirect('/tasks')->with('success', 'Task added successfully!');
    }
}
