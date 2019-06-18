<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Photo;

class PagesController extends Controller
{
    public function byUser()
    {
        $test = User::with('photos')->get();
    }
}
