<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;
    protected $table = 'service_providers';
    protected $primaryKey = 'serviceProviderID';

    public $timestamps = false;

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'serviceTypeID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function reviews()
    {
        return $this->hasMany(RateAndReview::class, 'serviceProviderID', 'serviceProviderID');
    }
    public function favouriteListContent()
    {
        return $this->hasOne(FavouriteListContent::class);
    }

    public function serviceProfile()
    {
        return $this->belongsTo(ServiceProfile::class, 'serviceProviderID');
    }
}
