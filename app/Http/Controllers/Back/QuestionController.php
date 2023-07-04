<?php

namespace App\Http\Controllers\Back;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class QuestionController extends Controller
{
    //
    public function index(){
        $myUser=Auth::user();
        $myQuestions=Question::paginate(10);
        return view('back.allQuestions', compact('myUser','myQuestions'))->with('title','Questions');
    }

    public function transfer($id){
        $question= Question::find($id);
        $question->update([
            'status'=>1,
        ]);
        
        return redirect()->back()->with(['success'=>'Converted to done status Successfully']);
    }
}
