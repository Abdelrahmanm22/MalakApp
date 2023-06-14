<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DropdownController extends Controller
{
    //
    public function index()
    {
        $data['books'] = Book::get(["name", "book_id"]);
        $myUser=Auth::user();
        return view('back.addVideo', $data,compact('myUser',));
    }
    public function index2()
    {
        $data['books'] = Book::get(["name", "book_id"]);
        $myUser=Auth::user();
        return view('back.addVoice', $data,compact('myUser',))->with('title','Add Videos');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fetchSection(Request $request)
    {
    
        $data['sections'] = Section::where("book_id", $request->book_id)
                                ->get(["title", "section_id"]);
  
        return response()->json($data);
    }
}
