<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['image_path1', 'comment', 'user_id'];
    //日付ミューテーターを使う
    protected $dates = ['created_at', 'updated_at'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    
    
}
