<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Support\Facades\Validator;
use App\Traits\files;
use Illuminate\Support\Str;
class VideoController extends Controller
{
    //
    use files;
    public function index(){
        $myUser=Auth::user();
        $myVideos=DB::table('users')
        ->join('videos', 'users.user_id', '=', 'videos.user_id')
        ->join('sections', 'sections.section_id', '=', 'videos.section_id')
        ->join('books', 'sections.book_id', '=', 'books.book_id')
        ->select('users.user_name','books.name as bookName','sections.section_id','sections.title as sectionTitle','users.user_id', 'videos.*')
        ->orderBy('videos.position', 'ASC')
        ->get();
        
        return view('back.allVideos', compact('myUser'),['myVideos' => $myVideos])->with('title','Videos');
    }
    public function reorder(Request $request){
        $posts = Video::all();

        foreach ($posts as $post) {
            foreach ($request->order as $order) {
                if ($order['id'] == $post->video_id){
                    $post->update(['position' => $order['position']]);
                }
            }
            
        }
        return response('Update Successfully.', 200);
    }
    public function addVideo(){
        $myUser=Auth::user();
        return view('back.addVideo', compact('myUser'))->with('title','Add Video');
    } 
    public function postAddVideo(Request $request){
        $video_file_name = "Not Found";
        $iframe = "NULL";
        $myUser=Auth::user();
        $validator = Validator::make($request->all(),[
            'title'=>'required|max:300',
            'description'=>'max:1000',
            'iframe' => 'required|max:500',
            'section_id'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        
        $iframe = '';
        $index = strpos($request->iframe, 'src="');
        $str=$request->iframe;
        for($i=$index+5;$i<Str::length($str);$i++){
            if($str[$i]=='"'){
                break;
            }
            $iframe.=$str[$i];
        }
        Video::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'iframe'=>$iframe,
            'section_id'=>$request->section_id,
            'user_id'=>$myUser->user_id,
        ]);
        return redirect()->back()->with(['success'=>'Added successfully']);
    }
    public function delete($id){
        
        $video = Video::find($id);
        if(!$video){
            return redirect()->back()->with(['error'=>'This Video not Found']);
        }
        $video ->delete();
        return redirect()->route('allVideos')->with(['success'=>'Deleted successfully']);
    }

    public function update($id){
        $myUser = Auth::user();
        $video= Video::find($id);
        return view('back.updateVideo',compact('myUser','video'))->with('title','Update Video');
    }


    public function postUpdate(Request $request,$id){
        $video = Video::find($id);
        $myUser = Auth::user();
        $validator = Validator::make($request->all(),[
            'title'=>'required|max:200',
            'description'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        
        
        $video->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>$myUser->user_id,
        ]);
        return redirect()->back()->with(['success'=>'updated Successfully']);
    }
    
}