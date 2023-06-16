<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RuleController extends Controller
{
    //
    public function index(){
        $myUser=Auth::user();
        $myRules=DB::table('users')
        ->join('rules', 'users.user_id', '=', 'rules.user_id')
        ->select('users.user_name','users.user_id', 'rules.*')
        ->get();
        return view('back.allRules', compact('myUser','myRules'))->with('title','Rules');
    }

    public function addRule(){
        $myUser=Auth::user();
        return view('back.addRule', compact('myUser'))->with('title','Add Rule');
    } 
    public function postAddRule(Request $request){
        $myUser=Auth::user();

        $validator = Validator::make($request->all(),[
            'question'=>'required|max:250',
            'questionDetails'=>'required|max:1000',
            'answer'=>'required|max:1000',
        ]);

        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        
        Rule::create([
            'question'=>$request->question,
            'questionDetails'=>$request->questionDetails,
            'answer'=>$request->answer,
            'user_id'=>$myUser->user_id,
        ]);
        return redirect()->back()->with(['success'=>'Added successfully']);
    }


    public function update($id){
        $myUser = Auth::user();
        $rule= Rule::find($id);
        return view('back.updateRule',compact('myUser','rule'))->with('title','Update Rule');
    }


    public function postUpdate(Request $request,$id){

        $rule = Rule::find($id);
        $myUser = Auth::user();
        $validator = Validator::make($request->all(),[
            'question'=>'required|max:250',
            'questionDetails'=>'required|max:1000',
            'answer'=>'required|max:1000',
        ]);

        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        
        $rule->update([
            'question'=>$request->question,
            'questionDetails'=>$request->questionDetails,
            'answer'=>$request->answer,
            'user_id'=>$myUser->user_id,
        ]);
        return redirect()->back()->with(['success'=>'updated Successfully']);
    }




    public function delete($id){
        $rule = Rule::find($id);
        if(!$rule){
            return redirect()->back()->with(['error'=>'This voice not Found']);
        }
        $rule->delete();
        return redirect()->route('allVideos')->with(['success'=>'Deleted successfully']);
    }
}
