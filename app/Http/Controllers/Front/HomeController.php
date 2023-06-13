<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Video;
use App\Models\Voice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $myVoices = Voice::get();
        $myVideos = Video::get();
        $settings=Setting::first();
        return view('front.index',compact('myVoices','myVideos','settings'));
    }
    public function biography(){
        $settings=Setting::first();
        return view('front.biography',compact('settings'));
    }
    public function video($id){
        $video = Video::find($id);
        if(!$video){
            return redirect()->back();
        }
        $settings=Setting::first();
        return view('front.video',compact('video','settings'));
    }
}
