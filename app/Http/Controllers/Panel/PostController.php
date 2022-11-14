<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Posts\CreatePostRequest;
use App\Http\Requests\Panel\Posts\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role === 'author'){
            $posts = Post::where('user_id' , auth()->user()->id)->with('user')->paginate();
        }else{
            $posts = Post::with('user')->paginate();
        }
        return view('panel.posts.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $categoryIds = Category::whereIn('name' , $request->categories)->get()->pluck('id')->toArray();
        if (count($categoryIds) < 1){
            throw ValidationException::withMessage([
                'categories' => ['یافت نشد']
            ]);
        }

        $data = $request->validated();

        $file = $request->file('banner');
        $file_name = $file->getClientOriginalName();
        $file->storeAs('images/banners' , $file_name , 'public_files');

        $data['banner'] = $file_name;
        $data['user_id'] = auth()->user()->id;
        $post = Post::create($data);
        $post->categories()->sync($categoryIds);
        session()->flash('status' , 'مقاله با موفقیت ایجاد شد');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('panel.posts.edit' , compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $categoryIds = Category::whereIn('name' , $request->categories)->get()->pluck('id')->toArray();
        if (count($categoryIds) < 1){
            throw ValidationException::withMessage([
                'categories' => ['یافت نشد']
            ]);
        }
        $data = $request->validated();
        if ($request->hasFile('banner')){
            $file = $request->file('banner');
            $file_name = $file->getClientOriginalName();
            $file->storeAs('images/banners' , $file_name , 'public_files');
            $data['banner'] = $file_name;
        }
        $post->update($data);
        $post->categories()->sync($categoryIds);
        session()->flash('status' , 'مقاله با موفقیت ویرایش شد');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete' , $post);
        $post->delete();
        session()->flash('status' , 'مقاله مورد نظر حذف شد');
        return back();
    }
}
