<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Come extends Model
{
    use HasFactory;

    protected $fillable = ['user_name', 'content'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'come_post', 'come_id', 'post_id');
    }
}
