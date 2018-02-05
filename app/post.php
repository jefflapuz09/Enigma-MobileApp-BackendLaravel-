<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'adminId',
        'categoryId',
        'image',
        'description',
        'created_at',
        'updated_at',
        'isActive'
    ];
}
