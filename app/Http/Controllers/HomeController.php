<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Photo;
use Carbon\Carbon;

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
        $year = date("Y"); //現在の年を取得
        $month = date("n"); //現在の月を取得

        return $this->common($year, $month);
    }
    public function prevMonth($year, $month)
    {
        if ($month == 1) {
            $month = 12;
            $year -= 1;
        } else {
            $month -= 1;
        }
        return $this->common($year, $month);
    }
    
    public function nextMonth($year, $month)
    {
        if ($month == 12) {
            $month = 1;
            $year += 1; 
        } else {
            $month += 1;
        }
        return $this->common($year, $month);
        
    }
    
    public function common($year, $month)
    {
        $myself = Auth::user();
        $users = User::all();
        $photos = Photo::latest('updated_at')->get();
        //月の日数を取得
        $countdate = date("t", mktime(0, 0, 0, $month, 1, $year));
        //当月1日の曜日を取得
        $first_day = date( "w", mktime( 0, 0, 0, $month, 1, $year ));
        // Photosテーブルから今月updated_atされたupdated_atカラムだけを配列として取得する。オブジェクトとして返ってくる
        $results = Photo::whereYear('updated_at', $year)->whereMonth('updated_at', $month)->select('updated_at')->get();
        if (!$results->isEmpty())
        {
            foreach($results as $result) {
                //日にちだけ取得
                $dates = $result->{'updated_at'}->day;
                // 日にちだけで配列を作る
                $updated_date[] = $dates;
            }
        }
        return view('home', compact('myself', 'users', 'photos', 'year', 'month', 'countdate', 'first_day','results','updated_date'));

    }
    
}
