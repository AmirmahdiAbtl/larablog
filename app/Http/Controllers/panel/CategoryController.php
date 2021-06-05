<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function index()
    {
        $category = Category::with('parentCategory')->paginate(5);
        return view('panel.category.index',['categories' => $category]);
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required','string','max:255'],
            'slug' => ['required','string','max:255','unique:categories'],
            'category_id' => ['nullable','exists:categories,id'],
        ]);
        Category::create(
            $request->only('name','slug','category_id')
        );
        session()->flash('status',"دسته بندی به درستی ثبت شد.");
        return back();
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Request $request,$id)
    {
        $category = Category::find($id);
        $all = Category::all();
        return view('panel.category.category-edit',['category'=>$category,"all"=>$all]);
    }
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'slug' => ['required','string','max:255',Rule::unique('categories')->ignore($category->id)],
            'category_id' => ['nullable','exists:categories,id'],
        ]);
        $category->update(
            $request->only(['name','slug','category_id'])
        );
        session()->flash('status','دسته بندی با موفقیت بروزرسانی شد');
        return redirect()->route('category.index');
    }
    public function destroy(Category $category)
    {
        session()->flash('status','دسته بنید با موفقیت حذف شد');
        $category->delete();
        return redirect()->route('category.index');
    }
}
