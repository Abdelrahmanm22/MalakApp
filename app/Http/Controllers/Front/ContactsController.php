<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Video;
use App\Models\Voice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ContactsController extends Controller
{
    //
    public function postContact(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:50',
            'email'=>'required',
            'phone'=>'required|numeric|digits:11',
            'message'=>'required'
        ]);

        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        Contact::create([
            'user_name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message,
        ]);
        return redirect()->back();
    }
}
