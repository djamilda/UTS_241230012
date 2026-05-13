<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'content', 'likes'];

    protected $casts = [
        'created_at' => 'datetime:d M Y H:i',
    ];
}