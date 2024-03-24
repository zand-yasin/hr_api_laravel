## To setup, please follow these instructions:

1. Copy `.env.example` to `.env`.
2. Fill `.env` variables to match your machine.
3. Type `php artisan migrate` for database migration.
4. Find the attached files `postman.json` and `database.sql` in the root directory to upload them into their destination.
5. Type `php artisan serve` to run the application.
6. Login to the system with email: `join.doe@gmail.com` and password: `password`.

## Run test:

1. Type `php artisan test` to test the API endpoints.

## Run commmands:

1. Type `php artisan export:employees employees.json` to export employees table as a JSON file, The exported file will be saved in the `storage/app/exports` directory.
2. Type `php artisan db:export db.sql` to export database SQL file, The exported file will be saved in the `database/exports`.
3. Type `php artisan employees:insert 10` to insert a specified number of employees into the database.
4. Type `php artisan logs:clear` to remove all log files from the storage directory.
5. Type `php artisan logs:delete-old-employee-logs` to delete all employee logs older than 1 month from the employee_logs.
