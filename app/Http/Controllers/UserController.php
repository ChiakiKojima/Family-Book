<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function mypage() {
        $myself = Auth::user();
        return view('user.mypage', [ 'myself' => $myself ]);
    }
    
    public function edit() {
        $myself = Auth::user();
        return view('user.edit', compact('myself'));
    }
    
    public function update(UserRequest $request) {
        $myself = Auth::user();
        $data = $request->validated();
        if (isset($data['icon'])) {            
            //画像をIntervention Imageに読み込ませる
            $img = Image::make($data['icon']);           
            // 横幅を指定する。高さは自動調整
            
            $img->fit(100,100, function($constraint){
                $constraint->upsize(); // 大きくなるのを防止
            });
            
            $file_path = storage_path(). '/app/public/user_images/';
            //ファイル名
            $file_name = $request->file('icon')->getClientOriginalName();
            //dump($file_name);
            //Intervention Imageに読み込ませたphotoを保存
            $img->save($file_path.$file_name); 
            //DBに保存する用に、パスを書き換える
            $read_path = str_replace('/home/ec2-user/environment/Family-Book/storage/app/public/', 'storage/', $file_path);
            $data['user_image'] = $read_path.$file_name;
            //dd($data);
        }
        $myself->update($data);
        
        \Flash::success('ユーザー情報を更新しました。');
        return redirect()->route('mypage');
        
    }
}
