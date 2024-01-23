<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function showMonthlyAgenda($month = null)
    {
        // If $month is null, use the current month
        if (!$month) {
            $month = Carbon::now()->format('Y-m');
        }

        // Convert the provided $month to a Carbon instance
        $date = Carbon::createFromFormat('Y-m', $month);

        // Get the current month and year for navigation
        $previousMonth = $date->copy()->subMonth()->format('Y-m');
        $nextMonth = $date->copy()->addMonth()->format('Y-m');

        // Calculate days for the provided month
        $daysInMonth = $date->daysInMonth;
        $calendar = [];
        $currentDate = Carbon::createFromDate($date->year, $date->month, 1);

        while ($currentDate->format('Y-m') === $month) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $week[] = $currentDate->copy()->format('d'); // Change the format as needed
                $currentDate->addDay();
            }
            $calendar[] = $week;
        }

        return view('agenda', [
            'calendar' => $calendar,
            'previousMonth' => $previousMonth,
            'nextMonth' => $nextMonth,
        ]);
    }
}
