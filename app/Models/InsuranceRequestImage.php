<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceRequestImage extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'insurance_request_images';
    protected $primaryKey = 'insuranceRequestImageID';
    public function insuranceRequest()
    {
        return $this->belongsTo(InsuranceRequest::class);
    }
}
