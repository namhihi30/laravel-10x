<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public $table = 'groups';
    public $fillable = ['name','phanquyen','user_id'];

    public function user()
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }

    public function postBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
