<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['image', 'comment', 'user_id', 'created_at'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
