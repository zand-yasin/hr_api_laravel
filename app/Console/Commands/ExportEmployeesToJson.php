<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use Illuminate\Support\Facades\File;

class ExportEmployeesToJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:employees {file : The name of the JSON file to export to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all employees to a JSON file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fileName = $this->argument('file');

        $employees = Employee::all();

        $jsonContent = $employees->toJson(JSON_PRETTY_PRINT);

        $path = storage_path("app/exports/{$fileName}");

        File::put($path, $jsonContent);

        $this->info("Employees exported successfully to: {$path}");

        return 0;
    }
}
