<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'author', 'avatar', 'verified', 'rating', 'variant', 'date', 'title', 'content', 'media', 'type' ,'created_at', 'updated_at'
    ];
    protected $casts = [
        'verified' => 'boolean',
        'rating'   => 'integer',
        'media'    => 'array',
        'date'     => 'date',
    ];
}
