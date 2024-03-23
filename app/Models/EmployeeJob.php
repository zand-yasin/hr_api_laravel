<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'employee_id',
    ];
    // Define the relationship with Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
