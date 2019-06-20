<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Photo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $myself = Auth::user();
        $users = User::all();
        $photos = Photo::latest('created_at')->get(); 
        
        //dump($photos);
        
        
        
        return view('home', compact('myself', 'users', 'photos'));
    }
}
