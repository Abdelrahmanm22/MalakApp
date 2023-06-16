<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\files;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BookController extends Controller
{
    //
    use files;
    public function index(){
        $myUser=Auth::user();
        $myBooks=DB::table('users')
        ->join('books', 'users.user_id', '=', 'books.user_id')
        ->select('users.user_name','users.user_id', 'books.*')
        ->get();
        return view('back.allBooks', compact('myUser','myBooks'))->with('title','Books');
    }
    public function addBook(){
        $myUser=Auth::user();
        
        return view('back.addBook', compact('myUser'))->with('title','Add Book');
    } 
    public function postAddBook(Request $request){
        $myUser=Auth::user();

        $validator = Validator::make($request->all(),[
            'name'=>'required|max:100|unique:books,name',
            'type'=>'required|max:250',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $image_file_name =$this->saveFile($request->image,'files/books');
        Book::create([
            'name'=>$request->name,
            'type'=>$request->type,
            'image'=>$image_file_name,
            'user_id'=>$myUser->user_id,
        ]);
        return redirect()->back()->with(['success'=>'Added successfully']);
    }
    public function update($id){
        $myUser = Auth::user();
        $book= Book::find($id);
        return view('back.updateBook',compact('myUser','book'))->with('title','Update Book');
    }


    public function postUpdate(Request $request,$id){

        $voice = Book::find($id);
        $myUser = Auth::user();
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:100',
            'type'=>'required|max:250',
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:200',
        ]);

        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        if(!empty($request->image)){ 
            $image_file_name =$this->saveFile($request->image,'files/books');
            $voice->update([
                'image'=>$image_file_name,
            ]);
        }
        $voice->update([
            'name'=>$request->name,
            'type'=>$request->type,
            'user_id'=>$myUser->user_id,
        ]);
        return redirect()->back()->with(['success'=>'updated Successfully']);
    }
}
