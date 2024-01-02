<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $primaryKey = 'orderID';

    public function location()
    {
        return $this->belongsTo(Location::class, 'locationID');
    }

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'serviceProviderID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function review()
    {
        return $this->hasOne(RateAndReview::class, 'orderID');
    }
}
