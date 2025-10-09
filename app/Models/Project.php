<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'long_description',
        'image',
        'github_url',
        'demo_url',
        'technologies',
        'featured',
        'order',
    ];

    protected $casts = [
        'technologies' => 'array',
        'featured' => 'boolean',
    ];
}
