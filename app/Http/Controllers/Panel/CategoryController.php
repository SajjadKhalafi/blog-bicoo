<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Category\CategoryCreateRequest;
use App\Http\Requests\Panel\Category\CategoryUpdateRequest;
use App\Models\Category;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('parent')->paginate(6);
        $parentCategories = Category::where('category_id', null)->get();
        return view('panel.categories.index', compact('categories', 'parentCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        $data = $request->validated();

        Category::create($data);

        session()->flash('status', 'دسته بندی مورد نظر با موفقیت ساخته شد!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
//    public function show(Category $category)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::where('category_id', null)->where('id', '!=', $category->id)->get();

        return view('panel.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        session()->flash('status' , 'دسته بندی مورد نظر با موفقیت ویرایش شد!');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('status', 'دسته بندی مورد نظر با موفقیت حذف شد!');
        return back();
    }
}
