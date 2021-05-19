<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = "user_infos";

    protected $fillable = ['user_id', 'dob', 'blood_group', 'promoter_name', 'promoter_mobile', 'address', 'photo', 'payment_mode', 'city', 'pincode'];
}
