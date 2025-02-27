<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','dummy_post_id'];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
