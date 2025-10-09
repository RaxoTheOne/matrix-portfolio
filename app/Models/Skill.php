<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'category',
        'level',
        'icon',
        'color',
        'order',
    ];

    protected $casts = [
        'level' => 'integer',
    ];
}
