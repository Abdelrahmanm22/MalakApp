<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Rule;
use App\Models\Section;
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
        $rules = Rule::all();
        return view('front.fatwas',compact('rules'));
    }

    public function sectionsVideo($id){
        $sections = DB::table('sections')->where('book_id', $id)
        ->get();
        $videos = DB::table('videos')->get();
        $myBook = Book::find($id);
        return view('front.video-book-sections',compact('sections','videos','myBook'));
    }
    public function getVideo($id){
        $myVideo = Video::find($id);
        return view('front.video',compact('myVideo'));

    }
    
    public function sectionsVoices($id){
        $sections = DB::table('sections')->where('book_id', $id)
        ->get();
        $myBook = Book::find($id);
        return view('front.voices-book-sections',compact('sections','myBook'));
    }
    public function getVoices($id){
        $voices = DB::table('voices')->where('section_id', $id)
        ->get();
        $mySection = Section::find($id);
        return view('front.voices',compact('voices','mySection'));
    }


}
