<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceRequest extends Model
{
    use HasFactory;
    protected $table = 'insurance_requests';
    protected $primaryKey = 'insuranceRequestID';
    public function images()
    {
        return $this->hasMany(InsuranceRequestImage::class);
    }
    public function insurance()
    {
        return $this->belongsTo(Insurance::class, 'insuranceID', 'insuranceID');
    }
}
