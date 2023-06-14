<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //
    public function index(){
        $myUser=Auth::user();
        $allContact = Contact::all();
        return view('back.contact', compact('myUser','allContact'))->with('title','Contact');
    }
}
