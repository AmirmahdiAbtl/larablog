<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class LandingController extends Controller
{
    public function index(Request $request){
        $post = Post::with(['user'])->paginate(5);
        if($request->category){
            $id = Category::where('slug',$request->category)->get('id');
            $category = Category::with('post')->find($id)->all();
            $post = $category[0]->post;
        }if($request->search){
            $post = Post::where('title','LIKE',"%{$request->search}%")->all();
        }
        return view('index',compact(['post']));
    }
    public function about(){
        return view('about');
    }
    
    public function contact(){
        return view('contact');
    }
}
