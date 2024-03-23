<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExportDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:export {file : The name of the SQL file to export to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export the database to a SQL file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fileName = $this->argument('file');

        $path = database_path('exports/' . $fileName);

        // Export the database to a SQL file
        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s > %s',
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_HOST'),
            env('DB_DATABASE'),
            $path
        );

        exec($command);

        $this->info('Database exported successfully to: ' . $path);

        return 0;
    }
}
