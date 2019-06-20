<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Photo;


class CommentsController extends Controller
{
    public function storeComment(Request $request)
    {
        // $comment = $request->validate([             
        //     'comment' => 'required',
        // ]);
        $input = \Request::all();
        dd($input);
        Comment::create($comment);
        return redirect('/');
    }
}
