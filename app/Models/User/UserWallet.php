<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    use HasFactory;

    protected $table = "user_wallets";
    protected $fillable = ['user_id', 'wallet_amt', 'income_date', 'level'];
}
