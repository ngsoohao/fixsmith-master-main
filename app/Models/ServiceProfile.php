<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProfile extends Model
{
    use HasFactory;
    protected $table = 'service_profiles';
    protected $primaryKey = 'serviceProfileID';

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'serviceProviderID');
    }
}