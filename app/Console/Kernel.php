<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $quotas    = DB::table('quotas')->where('status', '1')->where('due_date', '<' , date('Y-m-d'));
            foreach ($quotas->get() as $quota) {
                DB::table('loans')->where('id', $quota->loan_id)
                ->update([
                    'status'=> '4',
                ]);
            }
                      
            $quotas->update([
                'status'=> '3',
            ]);

        })->everyFifteenSeconds();
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
