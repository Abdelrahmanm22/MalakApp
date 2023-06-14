<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Voice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Traits\files;
class VoiceController extends Controller
{
    //
    use files;
    
    public function index(){
        $myUser=Auth::user();
        $myVoices=DB::table('users')
        ->join('voices', 'users.user_id', '=', 'voices.user_id')
        ->select('users.user_name','users.user_id', 'voices.*')
        ->get();
        return view('back.allVoices', compact('myUser','myVoices'))->with('title','Voice');
    }
    public function addVoice(){
        $myUser=Auth::user();
        return view('back.addVoice', compact('myUser'))->with('title','Add Voice');
    } 
    public function postAddVoice(Request $request){
        $myUser=Auth::user();

        $validator = Validator::make($request->all(),[
            'title'=>'required|max:100',
            'audio'=>'required',
        ]);

        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $audio_file_name =$this->saveFile($request->audio,'files/voices');
        Voice::create([
            'audio'=>$audio_file_name,
            'title'=>$request->title,
            'user_id'=>$myUser->user_id,
        ]);
        return redirect()->back()->with(['success'=>'Added successfully']);
    }
    public function delete($id){
        // echo $id;die;
        $voice = Voice::find($id);
        if(!$voice){
            return redirect()->back()->with(['error'=>'This voice not Found']);
        }
        $voice ->delete();
        return redirect()->route('allVoices')->with(['success'=>'Deleted successfully']);
    }
    public function update($id){
        $myUser = Auth::user();
        $voice= Voice::find($id);
        return view('back.updateVoice',compact('myUser','voice'))->with('title','Update Voice');
    }


    public function postUpdate(Request $request,$id){

        $voice = Voice::find($id);
        $myUser = Auth::user();
        $validator = Validator::make($request->all(),[
            'title'=>'required|max:100',
            
        ]);

        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        if(!empty($request->audio)){
            
            $audio_file_name =$this->saveFile($request->audio,'files/voices');
            $voice->update([
                'audio'=>$audio_file_name,
            ]);
        }
        $voice->update([
            'title'=>$request->title,
            'user_id'=>$myUser->user_id,
        ]);
        return redirect()->back()->with(['success'=>'updated Successfully']);
    }
}
