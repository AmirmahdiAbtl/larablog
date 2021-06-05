<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostPageController extends Controller
{
    public function index($slug){
        
        $post = Post::withCount('comment')->with(['category','comment'])->where('slug',$slug)->get()[0];
        $path = public_path('images\banner');
        return response()->file($path.'\\'.$post->banner);
        $comment = $post->comment;
        $comment = $comment->where('comment_id',null);
        return view('postpage',compact(['post','comment']));
    }
}
