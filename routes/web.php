<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PostPageController;
use App\Http\Controllers\panel\UserController;
use App\Http\Controllers\panel\CategoryController;
use App\Http\Controllers\panel\CommentController;
use App\Http\Controllers\panel\PostController;
use App\Http\Controllers\panel\EditorUploadController;
use App\Http\Controllers\panel\ProfileController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\panel\UserState;
use App\Models\User;

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

Route::get('/', [LandingController::class,'index'])->name('index');

Route::get('/about' ,[LandingController::class ,'about'])->name('about');
Route::get('/contact' ,[LandingController::class ,'contact'])->name('contact');

Route::get('/dashbord',[PanelController::class ,'index'])->middleware(['auth'])->name('panel');

Route::middleware(['auth','admin'])->prefix('/panel')->group(function (){
    Route::resource('/user', UserController::class)->except(['show']);
    Route::resource('/category', CategoryController::class)->except(['show']);
    Route::get('/comment', [CommentController::class,'index'])->name('comment.index');
    Route::delete('/comment/delete/{id}', [CommentController::class,'destroy'])->name('comment.delete');
    Route::put('/comment/update/{id}', [CommentController::class,'update'])->name('comment.update');
    Route::post('/comment/store', [CommentController::class,'store'])->name('comment.store');
});
Route::resource('/panel/post', PostController::class)->except(['show'])->middleware(['auth','author']);

Route::middleware('auth')->post('/panel/acceptrequest/{id}',[UserState::class,'accept'])->name('accept');
Route::middleware('auth')->post('/panel/rejectrequest/{id}',[UserState::class,'reject'])->name('reject');

Route::middleware('auth')->get('/panel/profile',[ProfileController::class,'index'])->name('profile.index');
Route::middleware('auth')->post('/panel/profile/update',[ProfileController::class,'update'])->name('profile.update');

Route::post('/editor/upload',[EditorUploadController::class,'upload'])->name('editor-upload');
require __DIR__.'/auth.php';

Route::get('/posts/{slug}',[PostPageController::class,'index'])->name('posts');
