<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeWorkLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'EmployeeID',
        'BranchID',
        'date_worked',
        'hours_worked'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
