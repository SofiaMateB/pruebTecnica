<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFeedback extends Model
{
    use HasFactory;
    protected $primaryKey = 'FeedbackID';
    public $incrementing = false;

    protected $fillable = [
        'FeedbackID',
        'CustomerID',
        'RentalID',
        'rating',
        'comments',
        'feedback_date'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
