<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class DeleteOldEmployeeLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:delete-old-employee-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete employee logs older than 1 month';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oneMonthAgo = Carbon::now()->subMonth();

        DB::table('employee_logs')->where('created_at', '<', $oneMonthAgo)->delete();

        $this->info('Employee logs older than 1 month have been deleted successfully.');
    }
}
