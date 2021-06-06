<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user()->role === "author"){
            $post = Post::where('user_id',auth()->user()->id)->with('user');
        }else{
            $post = Post::with('user');
        }
        if($request->search){
            $post = $post->where('title','LIKE',"%{$request->search}%");
        }
        $post = $post->paginate(5);
        return view('panel.post.index',['post'=>$post]);
    }

    public function create()
    {
        return view('panel.post.create_post');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => ['required','string','max:255'],
            'tags' => ['required','array'],
            'tags.*' => ['required','string'],
            'banner' => ['required','image'],
            'content' => ['required'],
        ]);

        $categoryId = Category::whereIn('slug',$request->tags)->get()->pluck('id')->toArray();
        if(count($categoryId) < 1){
            throw ValidationException::withMessages([
                'category' => ['دسته بندی یافت نشد'],
            ]);
        }
        $file = $request->file('banner');
        $file_name = $file->getClientOriginalName();
        $file->storeAs('images/banner',$file_name,'public_file');
        $posts = [
            'title' => $request->title,
            'tags' => $request->tags,
            'banner' => $file_name,
            'content' => $request->content, 
        ];
        $posts['user_id'] = auth()->user()->id;
        $post = Post::create($posts);
        $post->category()->sync($categoryId);
        $request->session()->flash('status','مقاله با موفقیت ساخته شد');
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Request $request,$id)
    {
        $post = Post::with('category')->find($id);
        return view('panel.post.edit_post',['post'=>$post]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $request->validate([
            'title' => ['required','string','max:255'],
            'tags' => ['required','array'],
            'tags.*' => ['required','string'],
            'banner' => ['nullable','image'],
            'content' => ['required'],
        ]);
        $data = [
            'title' => $request->title,
            'tags' => $request->tags,
            'content' => $request->content,
        ];
        if($request->hasFile('banner')){    
            $file = $request->file('banner');
            $base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $file_name = $base_name . "_" . time() . "." . $extension;
            $file->storeAs('images/banner',$file_name,'public_file');
            $data['banner'] = $file_name;
        }
        $categoryId = Category::whereIn('name',$request->tags)->get()->pluck('id')->toArray();
        $post->update($data);
        $post->category()->sync($categoryId);
        $request->session()->flash('status','مقاله با موفقیت بروز رسانی شد');
        return redirect()->route('post.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        session()->flash('status','مقاله به درستی حذف شد');
        return redirect()->route('post.index');
    }
    
}
