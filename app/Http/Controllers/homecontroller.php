<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homecontroller extends Controller
{
    public function index(){
        return view('index');
    }
    public function login(){
        return view('login');
    }
    public function regester(){
        return view('regester');
    }
    public function resetpass(){
        return view('resetpass');
    }
    public function post($id){
        return view('post');
    }
}
