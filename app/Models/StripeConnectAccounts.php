<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeConnectAccounts extends Model
{
    use HasFactory;
    protected $table = 'stripe_connect_accounts';
    protected $primaryKey = 'stripeConnectID';
}
