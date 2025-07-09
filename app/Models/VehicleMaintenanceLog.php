<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMaintenanceLog extends Model
{
    use HasFactory;
     protected $fillable = [
        'VehicleID',
        'maintenanceType',
        'costOfMaintenance',
        'lastMaintenanceDate',
        'nextServiceDueKM',
        'nextServiceDueDate',
        'mechanicName',
        'mechanicContact'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
