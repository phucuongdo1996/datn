<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('queue:work --stop-when-empty')->everyMinute()->withoutOverlapping();
//        $schedule->command('sub-user:destroy')->everyMinute();
        $schedule->command('check-profile:destroy')->everyFiveMinutes();
        $schedule->command('block-user:payment-error')->everyMinute();
        $schedule->command('pay:update-member-after-pay')->dailyAt("8:00");
        $schedule->command('pay:update-amount-before-pay')->dailyAt('8:00');
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
