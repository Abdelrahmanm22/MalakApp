<?php
namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\files;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    //
    public function index(){
        $myUser=Auth::user();
        $mySections=DB::table('users')
        ->join('sections', 'users.user_id', '=', 'sections.user_id')
        ->join('books', 'books.book_id', '=', 'sections.book_id')
        ->select('users.user_name','users.user_id', 'books.book_id','books.name','sections.*')
        ->get();
        return view('back.allSections', compact('myUser','mySections'))->with('title','Sections');
    }
    public function addSection(){
        $myUser=Auth::user();
        $books=Book::get();
        return view('back.addSection', compact('myUser','books'))->with('title','Add Section');
    } 
    public function postAddSection(Request $request){
        $myUser=Auth::user();

        $validator = Validator::make($request->all(),[
            'title'=>'required|max:100',
            'book'=>'required',
        ]);

        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        
        Section::create([
            'title'=>$request->title,
            'book_id'=>$request->book,
            'user_id'=>$myUser->user_id,
        ]);
        return redirect()->back()->with(['success'=>'Added successfully']);
    }
    public function update($id){
        $myUser = Auth::user();
        $section=DB::table('sections')
        ->join('books', 'books.book_id', '=', 'sections.book_id')
        ->select('books.book_id','books.name', 'sections.*')
        ->where('sections.section_id','=',$id)
        ->get()->first();
        $books=Book::get();
        return view('back.updateSection',compact('myUser','books','section'))->with('title','Update Section');
    }


    public function postUpdate(Request $request,$id){

        $section = Section::find($id);
        $myUser = Auth::user();
        $validator = Validator::make($request->all(),[
            'title'=>'required|max:100',
            'book'=>'required',
        ]);
        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $section->update([
            'title'=>$request->title,
            'book_id'=>$request->book,
            'user_id'=>$myUser->user_id,
        ]);
        return redirect()->back()->with(['success'=>'updated Successfully']);
    }
}
