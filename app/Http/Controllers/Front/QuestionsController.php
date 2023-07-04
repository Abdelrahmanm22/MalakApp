<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
{
    //
    public function postQuestion(Request $request){
        $validator = Validator::make($request->all(),[
            'sender'=>'required|max:70',
            'email'=>'required|max:100',
            'topic'=>'required|max:100',
            'question'=>'required|max:1500',
            
        ]);

        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        Question::create([
            'sender'=>$request->sender,
            'email'=>$request->email,
            'topic'=>$request->topic,
            'question'=>$request->question,
        ]);
        return redirect()->back();
    }
}
