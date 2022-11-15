<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->approved)){
            $comments = Comment::where('is_approved' , !!$request->approved)->with(['user' , 'post'])->withCount('replies')->paginate();
        }else{
            $comments = Comment::with(['user' , 'post'])->withCount('replies')->paginate();
        }
        return view('panel.comments.index' , compact('comments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'is_approved' => ! $comment->is_approved
        ]);
        session()->flash('status' , 'نظر با موفقیت به روزرسانی شد!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        session()->flash('status' , 'نظر مور نظر با موفقیت حذف شد!');
        return back();
    }
}
