## To setup, please follow these instructions:

1. Copy `.env.example` to `.env`.
2. Fill `.env` variables to match your machine.
3. Find the attached files `postman.json` and `database.sql` in the root directory to upload them into their destination if you want.
4. Type `composer install` to install application dependencies.
5. Type `php artisan migrate` for database migration incase you didn't upload the database file.
6. Type `php artisan serve` to run the application.
7. Simply register a new user with postman as postman collection provided, in order to Login.
8. Rate limiter is 10 perminute, you can change it in `app/Providers/RouteServiceProvider.php` file.

## Run test:

1. Type `php artisan test` to test the API endpoints.

## Run commmands:

1. Type `php artisan export:employees employees.json` to export employees table as a JSON file, The exported file will be saved in the `storage/app/exports` directory, also you need to create `/exports` directory before.
2. Type `php artisan db:export db.sql` to export database SQL file, The exported file will be saved in the `database/exports`, also you need to create `/exports` directory before.
3. Type `php artisan employees:insert 10` to insert a specified number of employees into the database.
4. Type `php artisan logs:clear` to remove all log files from the storage directory.
5. Type `php artisan logs:delete-old-employee-logs` to delete all employee logs older than 1 month from the employee_logs.
