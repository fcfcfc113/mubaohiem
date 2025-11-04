<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'parent_id','short_name','slug','name','description','category',
        'price','compare_at','thumbnail','images','created_at','updated_at','main'
    ];

    protected $casts = [
        'images'      => 'array',
        'price'       => 'float',
        'compare_at'  => 'float',
        'main'        => 'integer',
    ];

}
