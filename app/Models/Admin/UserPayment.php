<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    use HasFactory;

    protected $table = "user_payments";

    protected $fillable = ['user_id', 'order_id', 'transaction_id', 'payment_mode', 'payment_channel', 'payment_datetime', 'response_message'];
}
