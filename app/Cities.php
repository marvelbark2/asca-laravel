<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $casts = [
        'tasks' => 'array',
    ];
    protected $fillable = ['city', 'lat', 'lon', 'tasks'];

}
