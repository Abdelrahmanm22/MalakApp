<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    //
    public function index(){
        $myUser = Auth::user();
        $settings=Setting::first();
        return view('back.settings',compact('myUser','settings'))->with('title','setting');
    }

    public function update($id){
        $myUser = Auth::user();
        $settings= Setting::find($id);
        return view('back.updateSetting',compact('myUser','settings'))->with('title','setting');
    }

    public function postUpdate(Request $request,$id){

        $settings= Setting::find($id);
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:200',
            'phone' => 'required_without_all:video|numeric|digits:11',
            'desc'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        // echo $request->desc;die;
        
        $settings->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'cv'=>$request->desc,
            'user_id'=>$user->user_id,
        ]);
        return redirect()->back()->with(['success'=>'updated Successfully']);
    }
}
