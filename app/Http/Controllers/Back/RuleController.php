<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fatawasection;
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
        ->join('fatawasections', 'fatawasections.id', '=', 'rules.section_id')
        ->select('users.user_name','users.user_id', 'rules.*','fatawasections.name')
        ->orderBy('rules.position', 'ASC')
        ->get();
        return view('back.allRules', compact('myUser','myRules'))->with('title','Rules');
    }
    public function reorder(Request $request){
        $posts = Rule::all();

        foreach ($posts as $post) {
            foreach ($request->order as $order) {
                if ($order['id'] == $post->rule_id){
                    $post->update(['position' => $order['position']]);
                }
            }
            
        }
        return response('Update Successfully.', 200);
    }

    public function addRule(){
        $myUser=Auth::user();
        $sections=Fatawasection::get();
        return view('back.addRule', compact('myUser','sections'))->with('title','Add Rule');
    } 
    public function postAddRule(Request $request){
        $myUser=Auth::user();

        $validator = Validator::make($request->all(),[
            'question'=>'required|max:250',
            'questionDetails'=>'required|max:1000',
            'answer'=>'required|max:1000',
            'section'=>'required',
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
            'section_id'=>$request->section,
        ]);
        return redirect()->back()->with(['success'=>'Added successfully']);
    }


    public function update($id){
        $myUser = Auth::user();
        // $rule= Rule::find($id);
        $rule=DB::table('rules')
        ->join('fatawasections', 'fatawasections.id', '=', 'rules.section_id')
        ->select('fatawasections.id','fatawasections.name', 'rules.*')
        ->where('rules.rule_id','=',$id)
        ->get()->first();
        $sections=Fatawasection::get();
        return view('back.updateRule',compact('myUser','rule','sections'))->with('title','Update Rule');
    }


    public function postUpdate(Request $request,$id){

        $rule = Rule::find($id);
        $myUser = Auth::user();
        $validator = Validator::make($request->all(),[
            'question'=>'required|max:250',
            'questionDetails'=>'required|max:1000',
            'answer'=>'required|max:1000',
            'section'=>'required',
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
            'section_id'=>$request->section,
        ]);
        return redirect()->back()->with(['success'=>'updated Successfully']);
    }




    public function delete($id){
        $rule = Rule::find($id);
        if(!$rule){
            return redirect()->back()->with(['error'=>'This voice not Found']);
        }
        $rule->delete();
        return redirect()->route('rules')->with(['success'=>'Deleted successfully']);
    }
}
