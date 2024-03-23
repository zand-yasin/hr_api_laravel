<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'salary',
        'email',
        'password',
        'manager_id',
        'employee_job_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    // Define the relationship with EmployeeJob model
    public function employeeJobs()
    {
        return $this->hasMany(EmployeeJob::class);
    }
}
