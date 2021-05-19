<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    use HasFactory;

    protected $table = "user_plans";

    protected $fillable = ['user_id', 'plan_category', 'plan_amt', 'completion_time', 'busi_validity', 'payment_status'];
}
