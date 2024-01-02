<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class IdentityDocument extends Model
{
    use HasFactory;
    protected $table = 'identity_documents';
    protected $primaryKey = 'identityDocumentID';

    protected $fillable = [
        'fileName'
    ];

    
}
