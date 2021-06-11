<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

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
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')->everyMinute()
            ->then(fn() => $schedule->command('help')->everyMinute()
            )
            ->storeOutput();

        //Exmaple  calling custom command in Commands folder
        // $schedule->command('mycommand:archive-requests')->hourly();

        // EXAMPLE DELETE temp confirmation_code after an hour
        /*$schedule->call(function () {
            DB::table('confirmation_code')->delete();
        })->daily();*/

        // calling  invokable objects.   (Invokable objects are simple PHP classes that contain an __invoke method:)
        // $schedule->call(new DeleteRecentUsers)->daily();


        // Schedule Queue Jobs
        // $schedule->job(new Heartbeat)->everyFiveMinutes();

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
