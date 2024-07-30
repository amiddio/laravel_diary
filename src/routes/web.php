<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\Cabinet\BlogPostController;
use App\Http\Controllers\Cabinet\BlogTagController;
use App\Http\Controllers\Cabinet\CategoryController;
use App\Http\Controllers\Cabinet\DashboardController as CabinetDashboardController;
use App\Http\Controllers\Cabinet\DiaryPostController;
use App\Http\Controllers\Cabinet\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeDislikeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/')->group(function () {

    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

    Route::get('/blog/{tag_name?}', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{user_id}/{slug:slug}', [BlogController::class, 'show'])->name('blog.show');

    Route::post('/comments', [CommentController::class, 'store'])->middleware('auth')->name('comment.store');

    Route::post('/like_dislike', LikeDislikeController::class)->middleware('auth')->name('like_dislike');
});

Route::prefix('cabinet')->name('cabinet.')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', CabinetDashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/{id}/delete_avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.delete_avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('diary_posts', DiaryPostController::class);
    Route::get('/diary_posts/category/{slug:slug}', [DiaryPostController::class, 'filtered'])->name('diary_posts.filtered');

    Route::resource('blog_posts', BlogPostController::class);

    Route::resource('blog_tags', BlogTagController::class)->except('show');
});

require __DIR__.'/auth.php';
