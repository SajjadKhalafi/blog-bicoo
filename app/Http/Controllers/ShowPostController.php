<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ShowPostController extends Controller
{
    public function show(Post $post)
    {
        $post->load(['user' , 'categories' , 'comments' => function ($query){
            return $query->where('comment_id' , null)->where('is_approved' , true);
        }])->loadCount(['comments' => function ($query){
            return $query->where('is_approved' , true);
        }]);
        return view('post' , compact('post'));
    }
}
