<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'RentalID',
        'CustomerID',
        'VehicleID',
        'EmployeeID',
        'BranchID',
        'RentalDate',
        'ReturnDate',
        'dailyRate',
        'totalAmountPaid'
    ];

    public $incrementing = false; // porque `id` no es autoincremental

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function feedback()
    {
        return $this->hasOne(CustomerFeedback::class);
    }
}
