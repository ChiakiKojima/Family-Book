<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Auth;
use App\User;
use App\Photo;

class PhotosController extends Controller
{
    
    public function store(PhotoRequest $request)
    {
        
        $data = $request->validated();
        //dd($data);
        
        if (isset($data['photo'])) {            
            //画像をIntervention Imageに読み込ませる
            $img = Image::make($data['photo']);           
            // 横幅を指定する。高さは自動調整
            $width = 478;
            $img->resize($width, null, function($constraint){
                $constraint->aspectRatio();
            });
            
            //imagesフォルダは自動では作られない。自分で事前に作成しておくこと！
            $file_path = storage_path(). '/app/public/images/';
            //ファイル名
            $file_name = $request->file('photo')->getClientOriginalName();
            //dump($file_name);
            //Intervention Imageに読み込ませたphotoを保存
            $img->save($file_path.$file_name); 
            //DBに保存する用に、パスを書き換える
            $read_path = str_replace('/home/ec2-user/environment/Family-Book/storage/app/public/', 'storage/', $file_path);
            $data['image_path1'] = $read_path.$file_name;
            //dd($data);
        }
        Photo::create($data);
        return redirect()->route('home');
    }
    
    public function update(PhotoRequest $request, $id)
    {
        $photo = Photo::findOrFail($id);
        // dd($photo);
        $image = $photo->image_path1;
        $data = $request->validated();
        //dd($data);
        
        if (isset($data['photo'])) {
            File::delete($image);
            //画像をIntervention Imageに読み込ませる
            $img = Image::make($data['photo']);           
            // 横幅を指定する。高さは自動調整
            $width = 478;
            $img->resize($width, null, function($constraint){
                $constraint->aspectRatio();
            });
            $file_path = storage_path(). '/app/public/images/';
            //ファイル名
            $file_name = $request->file('photo')->getClientOriginalName();
            //dump($file_name);
            //Intervention Imageに読み込ませたphotoを保存
            $img->save($file_path.$file_name); 
            //DBに保存する用に、パスを書き換える
            $read_path = str_replace('/home/ec2-user/environment/Family-Book/storage/app/public/', 'storage/', $file_path);
            $data['image_path1'] = $read_path.$file_name;
            //dd($data);
        }
        $photo->update($data);
        return redirect()->route('home');
    }
    
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $image = $photo->image_path1;
        $photo->delete();
        //Family-Bookフォルダ内の写真fileも削除する
        File::delete($image);
        return redirect('/');
    }
    public function eachUser($id)
    {
        $myself = Auth::user();
        $user = User::findOrFail($id);
        $user_id = $user['id'];
        //Photosテーブルのカラム「user_id」が、「$user_id」というデータを取得する
        $photos = Photo::where('user_id', $user_id)->get(); 
        //dump($user);
        //dd($photos);

        return view('photos.each_user', compact('myself', 'user', 'photos'));
    }
    public function date($year, $month, $day)
    {   
        $myself = Auth::user();
        $linked = $year.'-'.$month.'-'.$day;
        $photos = Photo::whereDate('updated_at', $linked)->get();
        return view('photos.each_date', compact('year', 'month', 'day', 'myself', 'photos'));
    }
    
    public function search(Request $request)
    {
        $myself = Auth::user();
        $keyword = $request->validate([
            'search' => 'required'
        ]);
        //dd($keyword);

        $result = Photo::where('comment', 'LIKE', "%{$keyword['search']}%")
            ->orWhereHas('user', function($q) use ($keyword){
                $q->where('name', 'like', "%{$keyword['search']}%");
            })
            ->get();
        //dd($result);
        return view('photos.searched_result', compact('myself', 'keyword','result'));
        
    }
    
    
}
