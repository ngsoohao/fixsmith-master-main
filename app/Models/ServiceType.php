<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
    protected $table = 'serviceType';
    protected $primaryKey = 'serviceTypeID';

    public function serviceProvider()
    {
        return $this->hasMany(ServiceProvider::class, 'serviceTypeID');
    }
}
