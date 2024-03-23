<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

use App\Models\EmployeeLog;

class EmployeeLogHelper
{
    public static function logEmployeeOperation($employeeId, $method, $description = null)
    {
        $userId = auth()?->user()?->id ?? null;
        $log = new EmployeeLog();
        $log->created_by = $userId;
        $log->employee_id = $employeeId;
        $log->method = $method;
        $log->description = $description;
        $log->save();

        log::channel('employee')->debug("Created By: $userId, Employee ID: $employeeId, Method: $method, Description: $description");
    }
    public static function logEmployeeOperations($logData)
    {
        $logs = [];
        foreach ($logData as $data) {

            $employeeId = $data['employee_id'];
            $method = $data['method'];
            $description = $data['description'];
            $logs[] = [
                "employee_id" => $employeeId,
                "method" => $method,
                "description" => $description

            ];
            log::channel('employee')->debug("Employee ID: $employeeId, Method: $method, Description: $description");
        }

        EmployeeLog::insert($logs);
    }

}