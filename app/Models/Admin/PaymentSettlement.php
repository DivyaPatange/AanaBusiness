<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSettlement extends Model
{
    use HasFactory;
    
    protected $table = "payment_settlements";
    
    protected $fillable = ['settlement_id', 'user_id', 'total', 'from_date', 'to_date', 'settled_status', 'settled_date'];
}
