<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostPageController extends Controller
{
    public function index($slug){
        $post = Post::withCount('comment')->with(['category','comment'])->where('slug',$slug)->get()[0];
        $comment = $post->comment;
        $comment = $comment->where('comment_id',null);
        return view('postpage',compact(['post','comment']));
    }
}
