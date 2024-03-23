<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class ClearLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all log files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $logPath = storage_path('logs');
        $logFiles = File::files($logPath);

        foreach ($logFiles as $logFile) {
            File::delete($logFile);
        }

        $this->info('All log files have been removed.');

        return 0;
    }
}
