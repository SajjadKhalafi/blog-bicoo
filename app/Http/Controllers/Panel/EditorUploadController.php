<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorUploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('upload');

        $base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $ext = $file->getClientOriginalExtension();

        $file_name = $base_name . '_' . time() . '.' . $ext;

        $function = $request->CKEditorFuncNum;
        $url = asset('images/posts/' . $file_name);

        return response("<script>window.parent.CKEDITOR.tools.callFunction({$function},'{$url}', 'فایل به درستی اپلود شد')</script>");
    }
}
