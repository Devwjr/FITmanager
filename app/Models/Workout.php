<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = ['user_id', 'name', 'days_per_week', 'notes', 'items'];

    protected $casts = ['items' => 'array'];
}
