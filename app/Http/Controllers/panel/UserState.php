<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserState extends Controller
{
    public function accept(Request $request,$id){
        $user = User::find($id);
        $user->update([
            'state' => 1
        ]);
        $request->session()->flash('status','کاربر به درستی تایید شد');
        return redirect()->route('user.index');
    }
    public function reject(Request $request ,$id){
        $user = User::find($id);
        $user->update([
            'state' => 0
        ]);
        $request->session()->flash('status','کاربر به درستی رد شد');
        return redirect()->route('user.index');
    }
}
