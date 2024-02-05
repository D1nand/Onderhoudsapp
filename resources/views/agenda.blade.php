<!DOCTYPE html>
<html>

<head>
    <title>Monthly Agenda</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
@php
use Carbon\Carbon;
$urlSegments = explode('-', \Request::segment(2)); // Adjust the segment number based on your URL structure
$urlYear = $urlSegments[0] ?? null;
$urlMonth = $urlSegments[1] ?? null;

$urlDate = null;

// Check if both year and month are set
if ($urlYear !== null && $urlMonth !== null) {
$urlDate = Carbon::createFromDate($urlYear, $urlMonth, 1, 'Europe/Amsterdam');
}

$formattedUrlDate = $urlDate ? $urlDate->format('F Y') : null;
@endphp

<body>
    <div class="header">
        <h1>Onderhoudsapp</h1><br>
        <div class="header-buttons">
            <a href="{{ route('agenda', ['month' => now()->format('Y-m')]) }}" class="header-btn {{ Request::is('agenda*') ? 'active' : '' }}">Agenda</a>
            <a href="{{ route('tasks.create') }}" class="header-btn {{ Request::is('add-task') ? 'active' : '' }}">Taak Toevoegen</a>
            <a href="{{ route('task_management') }}" class="header-btn {{ Request::is('task-management') ? 'active' : '' }}">Taakbeheer</a>
            <a href="{{ route('logout') }}" class="header-btn">Uitloggen</a>
        </div>
    </div>

    <div class="agenda-container">
        <center>

            <h1>Agenda - {{ $formattedUrlDate }}</h1>

            <a href="{{ route('agenda', ['month' => $previousMonth]) }}">Vorige maand</a>
            <a href="{{ route('agenda', ['month' => $nextMonth]) }}">Volgende maand</a>
        </center>
        <table class="calendar">
            <thead>
                <tr>
                    <th>Maandag</th>
                    <th>Dinsdag</th>
                    <th>Woensdag</th>
                    <th>Donderdag</th>
                    <th>Vrijdag</th>
                    <th>Zaterdag</th>
                    <th>Zondag</th>
                </tr>
            </thead>
            <tbody>
                @php
                // Create a Carbon instance for the current date
                $currentDate = Carbon::now();

                // Get the current month and year for navigation
                $currentMonth = $currentDate->format('Y-m');
                $currentMonthOnly = $currentDate->format('m');

                // Check if the URL month matches the current month
                $isCurrentMonth = ($urlMonth == $currentMonthOnly);

                // Get the first day of the month
                $firstDayOfMonth = $urlDate ? Carbon::createFromDate($urlDate->year, $urlDate->month, 1) : null;

                $startDayOfWeek = $firstDayOfMonth ? $firstDayOfMonth->dayOfWeek : null;
                @endphp



                <!-- <tr>
                    @for ($i = 0; $i < $startDayOfWeek; $i++) <td class="empty-day">
                        </td>
                        @endfor -->

                @foreach ($calendar as $week)
                <tr>
                    @foreach ($calendar[0] as $day)
                    @php
                    $class = '';
                    $dayInt = intval($day);

                    // Check if the day is today and belongs to the specified month
                    if ($dayInt == $currentDate->day && $isCurrentMonth) {
                    $class = "current-day";
                    }
                    @endphp
                    <td class="{{ $class }}">
                        {{ $day }}
                    </td>
                    @endforeach
                </tr>
                @foreach ($calendar as $index => $week)
                @if ($index > 0)
                <tr>
                    @foreach ($week as $day)
                    @php
                    $class = '';
                    $dayInt = intval($day);

                    // Check if the day is today and belongs to the specified month
                    if ($dayInt == $currentDate->day && $isCurrentMonth) {
                    $class = "current-day";
                    }
                    @endphp
                    <td class="{{ $class }}">
                        {{ $day }}
                    </td>
                    @endforeach
                </tr>
                @endif
                @endforeach


            </tbody>
        </table>
    </div>
</body>

</html>