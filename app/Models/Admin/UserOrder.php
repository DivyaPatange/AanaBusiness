<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;

    protected $table = "user_orders";

    protected $fillable = ['user_id', 'order_number', 'pay_amount'];
}
