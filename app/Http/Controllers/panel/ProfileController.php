<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Panel\User\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index(){
        return view('panel.profile');
    }
    public function update(UpdateProfileRequest $request){
        $data = $request->validated();
        if($request->hasFile('profile')){
            $file = $request->file('profile');
            $base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $file_name = $base_name . "_" . time() . "." . $extension;
            $file->storeAs('images/profile',$file_name,'public_file');
            $data['profile'] = $file_name;
        }
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }else{
            unset($data['password']);
        }
        $user = User::find(auth()->user()->id);
        $user->update($data);
        session()->flash('status','اطلاعات کاربری با موفقیت بروزرسانی شد');
        return back();
    }
}
