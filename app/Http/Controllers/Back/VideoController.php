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
        ->select('users.user_name','sections.section_id','sections.title as sectionTitle','users.user_id', 'videos.*')
        ->get();
        return view('back.allVideos', compact('myUser','myVideos'))->with('title','Videos');
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
            'iframe' => 'required|max:250',
            'section_id'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        
        if(!empty($request->iframe)){
            $iframe = "";
            $index = strpos($request->iframe, '=');
            $str=$request->iframe;
            
            for($i=$index+1;$i<Str::length($str);$i++){
                $iframe.=$str[$i];
            }
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

    // public function update($id){
    //     $myUser = Auth::user();
    //     $video= Video::find($id);
    //     return view('back.updateVideo',compact('myUser','video'))->with('title','Update Video');
    // }


    // public function postUpdate(Request $request,$id){
    //     // echo $request->video;die;
    //     $video = Video::find($id);
    //     $myUser = Auth::user();
    //     $validator = Validator::make($request->all(),[
    //         'title'=>'required|max:200',
    //         'desc'=>'required',
    //         'iframe' => 'required_without_all:video',
    //         'video' => 'mimes:mp4,mov,avi|max:10000',
    //     ]);
    //     if($validator->fails()){
    //         return redirect()->back()->withErrors($validator);
    //     }
        
    //     //get Image for God
    //     if(!empty($request->video)){
    //         $audio_file_name =$this->saveFile($request->video,'files/videos');
    //         $video->update([
    //             'video'=>$audio_file_name,
    //         ]);
    //     }
    //     $video->update([
    //         'title'=>$request->title,
    //         'description'=>$request->desc,
    //         'iframe'=>$request->iframe,
    //         'user_id'=>$myUser->user_id,
    //     ]);
    //     return redirect()->back()->with(['success'=>'updated Successfully']);
    // }
    
}