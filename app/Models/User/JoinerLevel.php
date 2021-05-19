<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinerLevel extends Model
{
    use HasFactory;

    protected $table = "joiner_levels";

    protected $fillable = ['user_id', 'level', 'total_joiner', 'joiner_added', 'status'];
}
