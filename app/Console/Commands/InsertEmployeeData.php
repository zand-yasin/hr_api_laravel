<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;

class InsertEmployeeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:insert {count : The number of employees to insert}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert employee data with progress bar';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = $this->argument('count');

        $this->output->progressStart($count);

        for ($i = 0; $i < $count; $i++) {
            // Insert employee data here
            $employee = new Employee();
            // Example: Set employee name and salary
            $employee->name = 'Employee ' . ($i + 1);
            $employee->salary = 50000; // Example salary
            $employee->save();

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
        $this->info('Employee data inserted successfully.');

        return 0;
    }
}
