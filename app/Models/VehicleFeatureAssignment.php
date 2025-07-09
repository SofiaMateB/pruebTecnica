<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleFeatureAssignment extends Model
{
    use HasFactory;
    protected $table = 'vehicle_feature_assignment';

    protected $fillable = ['VehicleID', 'FeactureID'];
}
