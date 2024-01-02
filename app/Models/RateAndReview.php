<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateAndReview extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $primaryKey = 'reviewID';

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'serviceProviderID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID');
    }
}
