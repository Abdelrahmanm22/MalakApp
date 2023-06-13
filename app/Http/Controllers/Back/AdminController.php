<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //

    public function home(){
        $myUser = Auth::user();       
        return view('back.index',compact('myUser'))->with('title','Home');
    }

    public function login(){
        
        return view('back.login');
    }

    public function postLogin(Request $request){
        
        $validator = Validator::make($request->all(),[
            'email'=>'required',
            'password'=> 'required',
        ]);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $email = $request ->email;
        $pass = $request ->password;


        if(Auth::attempt(['email'=>$email,'password'=>$pass])) {
            $request->session()->regenerate();
            return redirect('/admin/home');
        }else{
            // return "ww";
            return redirect()->back()->with(['error'=>'email or password may be not correct']);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/admin/login');
    } 

    public function register(){
        
        return view('back.register');
    }

    public function postRegister(Request $request){
        //validate
        $validator = Validator::make($request->all(),[
            'username'=>'required|max:100',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:4',
        ]);

        //check if data is not correct
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }


        $password = Hash::make($request['password']);
        //push data in database
        User::create([
            'user_name'=>$request->username,
            'email'=>$request->email,
            'password'=> $password,
        ]);
        return redirect()->back()->with(['success'=>'registration successfully']);
    }
}
