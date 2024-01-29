<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;
use App\Models\Task;

class TaskController extends Controller
{
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $customMessages = [
            'taskname.required' => 'Vul aub de taaknaam in.',
            'taskname.string' => 'De taaknaam moet een tekst zijn.',
            'taskname.max' => 'De taaknaam mag niet langer zijn dan :max karakters.',
            'beginDate.required' => 'Vul aub de begindatum in.',
            'beginDate.date' => 'De begindatum moet een geldige datum zijn.',
            'endDate.required' => 'Vul aub de einddatum in.',
            'endDate.date' => 'De einddatum moet een geldige datum zijn.',
            'endDate.after' => 'De einddatum moet na de begindatum liggen.',
        ];

        $request->validate([
            'taskname' => 'required|string|max:255',
            'beginDate' => 'required|date',
            'endDate' => 'required|date|after:beginDate',
        ], $customMessages);

        try {
            $userId = auth()->user()->id;
            Task::create([
                'userId' => $userId,
                'taskname' => $request->input('taskname'),
                'beginDate' => $request->input('beginDate'),
                'endDate' => $request->input('endDate'),
            ]);

            return redirect()->route('tasks.create')->with('success', 'Taak succesvol toegevoegd!');
        } catch (ValidationException $e) {
            // If validation fails, redirect back with errors and old input
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
    }
}
