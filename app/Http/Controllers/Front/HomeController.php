<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Setting;
use App\Models\Video;
use App\Models\Voice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(){
        $myBooks = Book::all();
        return view('front.index',compact('myBooks'));
    }
    public function indexVoices(){
        $myBooks = Book::all();
        return view('front.voices-books',compact('myBooks'));
    }
    public function timeLectures(){
        return view('front.time-table');
    }
    public function fatawy(){
        return view('front.fatwas');
    }

    public function sectionsVideo($id){
        $sections = DB::table('sections')->where('book_id', $id)
        ->get();
        $videos = DB::table('videos')->get();
        return view('front.video-book-section',compact('sections','videos'));
    }
    public function getVideo($id){
        $myVideo = Video::find($id);
        return view('front.video',compact('myVideo'));

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
