<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteList extends Model
{
    use HasFactory;
    protected $table = 'favourite_lists';
    protected $primaryKey = 'favouriteListID';
}
