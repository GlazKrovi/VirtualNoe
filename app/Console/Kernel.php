<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            // Exécutez la fonction refresh du ClockController pour toutes les créatures
            $creatures = \App\Models\Creature::all();
            foreach ($creatures as $creature) {
                $controller = new \App\Http\Controllers\ClockController();
                $controller->refresh($creature->id);
            }
        })->everyFiveSeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
