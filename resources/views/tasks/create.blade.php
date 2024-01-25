<!DOCTYPE html>
<html>

<head>
    <title>Monthly Agenda</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="header">
        <h1>Onderhoudsapp</h1><br>
        <div class="header-buttons">
            <a href="{{ route('agenda') }}" class="header-btn {{ Request::is('agenda') ? 'active' : '' }}">Agenda</a>
            <a href="{{ route('tasks.create') }}" class="header-btn {{ Request::is('add-task') ? 'active' : '' }}">Taak Toevoegen</a>
            <a href="{{ route('task_management') }}" class="header-btn {{ Request::is('task-management') ? 'active' : '' }}">Taakbeheer</a>
            <a href="{{ route('logout') }}" class="header-btn">Uitloggen</a>
        </div>
    </div>

    <div class="container">
        <h2>Add Task</h2>
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="form-group">
                <label for="taskname">Task Name:</label>
                <input type="text" name="taskname" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="beginDate">Begin Date:</label>
                <input type="date" name="beginDate" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="endDate">End Date:</label>
                <input type="date" name="endDate" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>