<?php

namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Fatawasection;
use Illuminate\Support\Facades\Validator;

class FatawasectionController extends Controller
{
    //
    public function index(){
        $myUser=Auth::user();
        $mySections=DB::table('users')
        ->join('fatawasections', 'users.user_id', '=', 'fatawasections.user_id')
        ->select('users.user_name','users.user_id', 'fatawasections.*')
        ->get();
        return view('back.allSectionsFatwa', compact('myUser','mySections'))->with('title','Sections of Fatawy');
    }
    public function addSectionFatwa(){
        $myUser=Auth::user();
        return view('back.addSectionFatwa', compact('myUser'))->with('title','Add Section of Fatawy');
    }
    public function postAddSectionFatwa(Request $request){
        $myUser=Auth::user();

        $validator = Validator::make($request->all(),[
            'name'=>'required|max:100',
        ]);

        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        
        Fatawasection::create([
            'name'=>$request->name,
            'user_id'=>$myUser->user_id,
        ]);
        return redirect()->back()->with(['success'=>'Added successfully']);
    }

    public function update($id){
        $myUser = Auth::user();
        $section=DB::table('fatawasections')
        ->select('fatawasections.*')
        ->where('fatawasections.id','=',$id)
        ->get()->first();
        return view('back.updateSectionFatwa',compact('myUser','section'))->with('title','Update Section of Fatawy');
    }

    public function postUpdate(Request $request,$id){
        
        $section = Fatawasection::find($id);

        $myUser = Auth::user();
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:100',
        ]);
        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        // echo $request->book;die;
        $section->update([
            'name'=>$request->name,
            'user_id'=>$myUser->user_id,
        ]);
        return redirect()->back()->with(['success'=>'updated Successfully']);
    }

}
