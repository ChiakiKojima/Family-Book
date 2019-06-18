<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\PhotoRequest;
use Intervention\Image\Facades\Image;
use Auth;
use App\User;
use App\Photo;

class PhotosController extends Controller
{
    public function store(Request $request)
    {
        //まずphoto以外のpostデータを$dataに代入　photoは入ってこない
        $data = \Request::all();                           //$request->validate();          //
        dump($data);
        if ($request->file['photo']) {                            //$request->file('photo')
            //画像をIntervention Imageに読み込ませる
            $img = Image::make($data[photo]);           //Input::file('photo')
            // 横幅を指定する。高さは自動調整
            $width = 478;
            $img->resize($width, null, function($constraint){
                $constraint->aspectRatio();
            });
            //ファイル名はcreated_at.jpegにする
            $save_path = "public/images/$data[created_at].'.jpeg'";
            //upしたphotoを保存　
            $img->save($save_path);
            //読込先と保存先が異なるので、bladeで表示させるためのファイルパスに変換
            $read_path = str_replace('public/', 'storage/', $save_path);
            //データベースにまとめて保存するため、配列に$read_path(photoファイルのパス)を追加
            $data['image_path1'] = $read_path;
        }
        //dd($data);
        Auth::user()->photos()->create($data);
        return redirect()->route('home');
    }
    
    public function byUser($id) {
        $user = User::findOrFail($id);
        $user_id = $user['id'];
        //Photosテーブルのカラム「user_id」が、「$user_id」というデータを取得する
        $photos = Photo::where('user_id', $user_id)->get(); 
        //dump($user);
        //dd($photos);

        return view('photos.by_user', compact('user', 'photos'));
    }
}
