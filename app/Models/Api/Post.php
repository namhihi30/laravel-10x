<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $table = "api_posts";
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
