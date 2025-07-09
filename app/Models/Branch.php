<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['location', 'address', 'phone'];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function employeeWorkLogs()
    {
        return $this->hasMany(EmployeeWorkLog::class);
    }
}
