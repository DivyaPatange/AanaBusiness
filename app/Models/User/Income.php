<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = "incomes";

    protected $fillable = ['user_id', 'child_id', 'level', 'plan_amount', 'payment_date', 'income_amount', 'settled_status'];
}
