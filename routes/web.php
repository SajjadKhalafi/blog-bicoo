<?php

use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\CommentController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\EditorUploadController;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\Panel\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::middleware(['auth' , 'admin'])->prefix('/panel')->group(function (){
    Route::resource('/users' , UserController::class)->except(['show']);
    Route::resource('/categories' , CategoryController::class)->except(['show' , 'create']);
});

Route::middleware(['auth' , 'author'])->prefix('/panel')->group(function (){
    Route::resource('/posts' , PostController::class);
    Route::post('/editor/upload' , [EditorUploadController::class , 'upload'])
        ->name('editor-upload');
    Route::resource('/comments' , CommentController::class)->only(['index' , 'destroy', 'update']);
});

Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', [DashboardController::class , 'index'] )->name('dashboard');

    Route::get('/profile', [ProfileController::class , 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class , 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
