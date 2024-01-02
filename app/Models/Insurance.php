<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    protected $table = 'insurances';
    protected $primaryKey = 'insuranceID';
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID');
    }
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'serviceProviderID');
    }
}
