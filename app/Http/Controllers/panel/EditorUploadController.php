<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorUploadController extends Controller
{
    public function upload(Request $request){
        // dd($request->all());
        $file = $request->file('upload');
        $base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $file_name = $base_name . "_" . time() . "." . $extension;
        $file->storeAs('images/posts',$file_name,'public_file');
        $url = asset('images/posts/'.$file_name);
        
        $function = $request->CKEditorFuncNum;
        return response("<script>window.parent.CKEDITOR.tools.callFunction({$function},'{$url}','فایل به درستی اپلود شد')</script>");
        
    }
}
