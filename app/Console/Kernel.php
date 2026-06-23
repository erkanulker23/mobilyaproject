<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(\Spatie\Health\Commands\RunHealthChecksCommand::class)
            ->everyFiveMinutes();
        $schedule->command('queue:prune-batches --hours=48 --unfinished=72')->daily();
        $schedule->command('queue:prune-failed --hours=48')->daily();
        $schedule->command('queue:retry all')->everyFiveMinutes();

        $schedule->command('sitemap:generate')->daily();

        $schedule->command('app:reset')
            ->hourly()
            ->when(function () {
                return config('app.is_demo');
            });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
