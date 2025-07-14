<?php

namespace App\Console;

use App\Models\Loan;
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
        $schedule->call(function () {
            $quotas    = DB::table('quotas')->where('status', '1')->where('due_date', '<' , date('Y-m-d'));
            foreach ($quotas->get() as $quota) {
                $loan = Loan::find($quota->loan_id);
                $loan->status = '4';
                $loan->amount_to_pay = $this->updateAmounWithDelay($loan);      
                $loan->save();        
            }
                      
            $quotas->update([
                'status'=> '3',
            ]);

        })->everyFifteenSeconds();

        $schedule->call(function () {
            date_default_timezone_set('America/Asuncion');
            $links = DB::table('links')->where('status', '1')->where('due_time', '<' , date('Y-m-d H:i:s'));
          
            $links->update([
                'status'=> 0,
            ]);
        })->everyFifteenSeconds();
        
        $schedule->call(function () {
            date_default_timezone_set('America/Asuncion');
            $links = DB::table('dropshipping_links')->where('status', '1')->where('due_time', '<' , date('Y-m-d H:i:s'));
          
            $links->update([
                'status'=> 0,
            ]);
        })->everyFifteenSeconds();
    }
    private function updateAmounWithDelay($loan){
        return ((($loan->amount_quota * $loan->interest_for_delay)/100) + $loan->amount_to_pay);
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
