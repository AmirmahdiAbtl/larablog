<?php

namespace App\Http\Controllers\panel;

use App\Models\comment;
use App\Models\Useer;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comment = comment::with(['comments','user','post']);
        if(isset($request->status)){
            $comment->where('status',$request->status);
        }
        $comment = $comment->paginate();
        return view('panel.comment.index',['comment'=>$comment]);
    }

    public function destroy($id)
    {
        $comment = comment::find($id);
        $comment->delete();
        session()->flash('status','نطرات به درستی حذف شد.');
        return redirect()->route('comment.index');
    }

    public function update($id)
    {
        $comment = comment::find($id);
        $new_status = !$comment->status;
        $comment->update([
            'status' => $new_status,
        ]);
        session()->flash('status','نطرات به درستی ویرایش شد.');
        return redirect()->route('comment.index');
    }
    public function store(Request $request){
        $data = [
            'comment' => $request->comment,
            'user_id' => auth()->user()->id,
            'post_id' => $request->post_id,
        ];
        if($request->comment_id){
          $data['comment_id'] = $request->comment_id;  
        }
        comment::create($data);
        session()->flash('status','نظر با موفقیت ثبت شد');
        return back();
    }
}
