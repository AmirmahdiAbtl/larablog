<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 

class UserController extends Controller
{
    public function index()
    {
        $user = User::paginate(5);
        return view('panel.users',['user'=>$user]);
    }

    public function create()
    {
        return view('panel.create-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:255',
            'role' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $request->password,
            'role' => $request->role,
        ]);
        $request->session()->flash('status','کاربر به درستی افزوده شد');
        return redirect()->route('user.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('panel.edit-user',['user'=>$user]);
    }

    public function update(Request $request, $id, User $users)
    {
        // dd($users);
        $user = User::find($id);
        $request->validate([
            'name'=> 'required|string|max:255',
            'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($user->id)],
            'mobile' =>  ['required','string','max:255',Rule::unique('users')->ignore($user->id)],
            'role' => 'required',
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'role' => $request->role,
        ]);
        $request->session()->flash('status','کاربر به درستی بروزرسانی شد');
        return redirect()->route('user.index');
    }
    
    public function destroy(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $request->session()->flash('status','کاربر به درستی حذف شد');
        return redirect()->route('user.index');
    }
}
