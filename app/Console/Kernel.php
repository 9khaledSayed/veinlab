<?php

namespace App\Console;

use App\Console\Commands\CalcProfit;
use App\Console\Commands\CarriedDays;
use App\Console\Commands\DailyReport;
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
        CalcProfit::class,
        DailyReport::class,
        CarriedDays::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('calc:profit')->daily();
         $schedule->command('daily:report')->daily();
         $schedule->command('carried:days')->yearly();

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
