<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:notifikasiAgenda')->everyMinute();
        $schedule->command('command:notifikasiPersonal')->everyMinute();
        $schedule->command('command:notifikasiAbsenPagi')->weekdays()->dailyAt('07:00');
        $schedule->command('command:notifikasiAbsenSore')->weekdays()->dailyAt('17:30');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
