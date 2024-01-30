<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task; // Make sure to import your Task model
use Carbon\Carbon;
use App\Notifications\TaskNotification;

class CheckActiveTasks extends Command
{
    protected $signature = 'tasks:check';
    protected $description = 'Check and notify about active tasks';

    public function handle()
    {
        $today = Carbon::now()->toDateString();

        $activeTasks = Task::where('beginDate', '<=', $today)
                          ->where('endDate', '>=', $today)
                          ->get();

        foreach ($activeTasks as $task) {
            $user = $task->userId; // Assuming there is a user relationship in your Task model
            $user->notify(new TaskNotification($task->name));
        }

        $this->info('Active tasks checked and notifications sent.');
    }
}
