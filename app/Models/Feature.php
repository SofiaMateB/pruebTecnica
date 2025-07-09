<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $primaryKey = 'FeactureID';
    public $incrementing = false;

    protected $fillable = [
        'FeactureID',
        'feature_name',
        'feature_description',
        'price_impact'
    ];

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'vehicle_feature_assignment');
    }
}
