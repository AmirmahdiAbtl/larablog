<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\comment;


class PanelController extends Controller
{
    public function index(){
        $userCount = User::count();
        $postCount = Post::count();
        $categoryCount = Category::count();
        $commentCount = comment::count();
        if(auth()->user()->role==="author"){
            $postCount = Post::where('user_id',auth()->user()->id)->count();
            $commentCount = comment::whereHas('post',function($query){
                return $query->where('user_id',auth()->user()->id);
            })->count();
        }
        return view('panel',compact('userCount','postCount','categoryCount','commentCount'));
    }
}