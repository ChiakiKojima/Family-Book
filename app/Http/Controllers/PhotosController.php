<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
//use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Auth;
use App\User;
use App\Photo;
use JD\Cloudder\Facades\Cloudder;

class PhotosController extends Controller
{
    
    public function store(PhotoRequest $request)
    {
        
        $data = $request->validated();
        //dd($data);
        
        if (isset($data['photo'])) {
            //dd($file);
            $file_name = $data['photo']->getRealPath();
            //dd($file_name);
            Cloudder::upload($file_name, null, array("width"=>478, "crop"=>"scale", "folder" => "photos"));
            $data['publicId'] = Cloudder::getPublicId();
            $data['image_path1'] = Cloudder::secureShow($data['publicId']);
            //画像をIntervention Imageに読み込ませる
            //$img = Image::make($data['photo']);           
            // 横幅を指定する。高さは自動調整
            //$width = 478;
            //$img->resize($width, null, function($constraint){
            //     $constraint->aspectRatio();
            // });
            //imagesフォルダは自動では作られない。自分で事前に作成しておくこと！
            //$file_path = storage_path(). '/app/public/images/';
            //ファイル名
            //$file_name = $request->file('photo')->getClientOriginalName();
            //dump($file_name);
            //Intervention Imageに読み込ませたphotoを保存
            //$img->save($file_path.$file_name); 
            //DBに保存する用に、パスを書き換える
            //$read_path = str_replace('/home/ec2-user/environment/Family-Book/storage/app/public/', 'storage/', $file_path);
            //$data['image_path1'] = $read_path.$file_name;
            //dd($data);
        }
        Photo::create($data);
        return redirect()->route('home');
    }
    
    public function update(PhotoRequest $request, $id)
    {
        $photo = Photo::findOrFail($id);
        // dd($photo);
        $publicId = $photo->publicId;
        $data = $request->validated();
        //dd($data);
        
        if (isset($data['photo'])) {
            Cloudder::destroyImage($publicId);
            $file_name = $data['photo']->getRealPath();
            Cloudder::upload($file_name, null, array("width"=>478, "crop"=>"scale", "folder" => "photos"));
            $data['publicId'] = Cloudder::getPublicId();
            $data['image_path1'] = Cloudder::secureShow($data['publicId']);
            //File::delete($image);
            //画像をIntervention Imageに読み込ませる
            //$img = Image::make($data['photo']);           
            // 横幅を指定する。高さは自動調整
            //$width = 478;
            //$img->resize($width, null, function($constraint){
                //$constraint->aspectRatio();
            // });
            // $file_path = storage_path(). '/app/public/images/';
            //ファイル名
            //$file_name = $request->file('photo')->getClientOriginalName();
            //dump($file_name);
            //Intervention Imageに読み込ませたphotoを保存
            //$img->save($file_path.$file_name); 
            //DBに保存する用に、パスを書き換える
            //$read_path = str_replace('/home/ec2-user/environment/Family-Book/storage/app/public/', 'storage/', $file_path);
            //$data['image_path1'] = $read_path.$file_name;
            //dd($data);
        }
        $photo->update($data);
        return redirect()->route('home');
    }
    
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $publicId = $photo->publicId;
        Cloudder::destroyImage($publicId);
        $photo->delete();
        //Family-Bookフォルダ内の写真fileも削除する
        //File::delete($image);
        return redirect('/');
    }
    public function eachUser($id)
    {

        $user = User::findOrFail($id);
        $user_id = $user['id'];
        //Photosテーブルのカラム「user_id」が、「$user_id」というデータを取得する
        $photos = Photo::where('user_id', $user_id)->latest('updated_at')->get(); 
        //dump($user);
        //dd($photos);
        $data = $this->getData();
        
        return view('photos.each_user', $data, compact('user','photos'));
    }
    public function date($year, $month, $day)
    {   
        $linked = $year.'-'.$month.'-'.$day;
        $photos = Photo::whereDate('updated_at', $linked)->latest('updated_at')->get();
        
        $data = $this->getData();
        
        return view('photos.each_date', $data, compact('day', 'photos'));
    }
    
    public function search(Request $request)
    {
        $keyword = $request->validate([
            'search' => 'required'
        ]);
        //dd($keyword);
        $result = Photo::where('description', 'LIKE', "%{$keyword['search']}%")
            ->orWhereHas('user', function($q) use ($keyword){
                $q->where('name', 'like', "%{$keyword['search']}%");
            })
            ->latest('updated_at')->get();
        //dd($result);
        $data = $this->getData();
        return view('photos.searched_result', $data, compact('keyword','result'));
        
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
        }
        return compact('myself', 'users', 'year', 'month','countdate', 'first_day', 'results', 'updated_date');
    }
    
    
}
