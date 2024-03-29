<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserRequest;
//use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\User;
use App\Photo;
use JD\Cloudder\Facades\Cloudder;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    private function getData() {
        $myself = Auth::user();
        $users = User::all();
        $year = date("Y"); //現在の年を取得
        $month = date("n"); //現在の月を取得
        $countdate = date("t", mktime(0, 0, 0, $month, 1, $year));
        $first_day = date( "w", mktime( 0, 0, 0, $month, 1, $year ));
        $results = Photo::whereYear('updated_at', $year)->whereMonth('updated_at', $month)->select('updated_at')->get();
        if (!$results->isEmpty())
        {
            foreach($results as $result) {
                $dates = $result->{'updated_at'}->day;
                $updated_date[] = $dates;
            }
        } else {
            $updated_date[] = null;
        }
        return compact('myself', 'users', 'year', 'month','countdate', 'first_day', 'results', 'updated_date');
    }
    
    public function mypage() {
        $data = $this->getData();
        return view('user.mypage', $data);
    }
    
    public function edit() {
        $data = $this->getData();
        return view('user.edit', $data);
    }
    
    public function update(UserRequest $request) {
        $myself = Auth::user();
        $data = $request->validated();
        if (isset($data['icon'])) {
            if (!is_null($myself['publicId'])) {
                Cloudder::destroyImage($myself['publicId']);
            }
            $file_name = $data['icon']->getRealPath();
            Cloudder::upload($file_name, null, array(
                "width"=>200, 
                "height"=>200, 
                "radius"=>"max", 
                "crop"=>"fill", 
                "folder" => "users"));
            $data['publicId'] = Cloudder::getPublicId();
            $data['user_image'] = Cloudder::secureShow($data['publicId']);
            //画像をIntervention Imageに読み込ませる
            //$img = Image::make($data['icon']);           
            // 横幅を指定する。高さは自動調整
            
            // $img->fit(100,100, function($constraint){
            //     $constraint->upsize(); // 大きくなるのを防止
            // });
            
            //$file_path = storage_path(). '/app/public/user_images/';
            //ファイル名
            //$file_name = $request->file('icon')->getClientOriginalName();
            //dump($file_name);
            //Intervention Imageに読み込ませたphotoを保存
            //$img->save($file_path.$file_name); 
            //DBに保存する用に、パスを書き換える
            // $read_path = str_replace('/home/ec2-user/environment/Family-Book/storage/app/public/', 'storage/', $file_path);
            // $data['user_image'] = $read_path.$file_name;
            //dd($data);
        }
        $myself->update($data);
        
        \Flash::success('ユーザー情報を更新しました。');
        return redirect()->route('mypage');
        
    }
    public function destroyUser()
    {
        $myself = Auth::user();
        $photos = Photo::where('user_id', $myself->id)->select('publicId')->get();
        //dd($photos);
        if ($user_image = $myself->publicId) {
            Cloudder::destroyImage($user_image);
        }
        if ($photos) {
           foreach($photos as $photo) {
               //dd($photo->publicId);
               Cloudder::destroyImage($photo->publicId);
           }
        }
        $myself->delete();
        
        return redirect('/');
    }
}
