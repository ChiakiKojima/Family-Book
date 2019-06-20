<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Photo;


class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->validated([             
            'comment' => 'required|string',
            'user_id' => 'required',
            'photo_id' => 'required'
        ]);
        //dd($input);
        Comment::create($comment);
        return redirect('/');
    }
}
