<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

       protected $fillable = ['name', 'email', 'phone'];
public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(CustomerFeedback::class);
    }
}
