<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
        protected $primaryKey = 'VehicleID';
    protected $fillable = ['make', 'model', 'year', 'license_plate','dailyRate'];
 public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(VehicleMaintenanceLog::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'vehicle_feature_assignment');
    }
}
