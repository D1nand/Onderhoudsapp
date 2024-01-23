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
            <a href="{{ route('add_task') }}" class="header-btn {{ Request::is('add-task') ? 'active' : '' }}">Taak Toevoegen</a>
            <a href="{{ route('task_management') }}" class="header-btn {{ Request::is('task-management') ? 'active' : '' }}">Taakbeheer</a>
            <a href="{{ route('logout') }}" class="header-btn">Uitloggen</a>
        </div>
    </div>

    <div class="agenda-container">
        <center>
            @php
            use Carbon\Carbon;

            $urlSegments = explode('-', \Request::segment(2)); // Adjust the segment number based on your URL structure
            $urlYear = $urlSegments[0] ?? null;
            $urlMonth = $urlSegments[1] ?? null;


            $urlDate = Carbon::createFromDate($urlYear, $urlMonth, 1, 'Europe/Amsterdam');

            $formattedUrlDate = $urlDate->format('F Y');


            @endphp

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

        $currentMonth = $currentDate->format('Y-m');

        $currentMonthOnly = $currentDate->format('m');

        // Check if the URL month matches the current month
        $isCurrentMonth = ($urlMonth == $currentMonthOnly);
    @endphp

                @foreach ($calendar as $week)
                <tr>
                    @foreach ($week as $day)
                    @php
                    $class = '';

                    // Assuming $day is in the '01' format
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
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>