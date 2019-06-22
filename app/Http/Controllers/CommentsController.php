<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Photo;
use App\Comment;


class CommentsController extends Controller
{
    
    public function store(Request $request)
    {
        $input = $request->validate([             
            'comment' => 'required|string',
            'user_id' => 'required',
            'photo_id' => 'required'
        ]);
        //dd($input);
        Comment::create($input);
        return redirect('/');
    }
}
