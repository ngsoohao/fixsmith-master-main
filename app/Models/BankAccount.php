<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $table = 'bankaccount';
    protected $primaryKey = 'bankAccountID';
    protected $fillable = ['accountNumber', 'bankName', 'accountHolderName', 'id'];
}
