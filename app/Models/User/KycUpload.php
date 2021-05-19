<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KycUpload extends Model
{
    use HasFactory;

    protected $table = "kyc_uploads";

    protected $fillable = ['user_id', 'pan_img', 'aadhar_img', 'user_img'];
}
