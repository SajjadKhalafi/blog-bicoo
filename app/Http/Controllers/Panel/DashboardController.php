<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::count();
        $posts_count = Post::count();
        $categories_count = Category::count();
        $comments_count = Comment::count();
        if (auth()->user()->role === 'author'){
            $posts_count = Post::where('user_id' , auth()->user()->id)->count();
            $comments_count = Comment::whereHas('post' , function($query){
                return $query->where('user_id' , auth()->user()->id);
            })->count();
        }
        return view('panel.index', compact('posts_count', 'users_count', 'categories_count', 'comments_count'));
    }
}
