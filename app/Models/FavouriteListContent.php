<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteListContent extends Model
{
    use HasFactory;
    protected $table = 'favourite_list_contents';
    protected $primaryKey = 'favouriteListContentID';

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'serviceProviderID');
    }
}
