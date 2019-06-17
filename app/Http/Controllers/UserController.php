<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function mypage() {
        $user = Auth::user();
        return view('user.mypage', [ 'user' => $user ]);
    }
    
    public function edit() {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }
    
    public function update(UserRequest $request) {
        $user = Auth::user();
        $user->update($request->validated());
        \Flash::success('ユーザー情報を更新しました。');
        return redirect()->route('mypage');
        
    }
}
