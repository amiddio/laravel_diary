<?php

use App\Http\Controllers\BlogTagController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiaryPostController;
use App\Http\Controllers\BlogPostController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/{id}/delete_avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.delete_avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categories', CategoryController::class)->except('show');

    Route::resource('diary_posts', DiaryPostController::class);
    Route::get('diary_posts/category/{slug:slug}', [DiaryPostController::class, 'filtered'])->name('diary_posts.filtered');

    Route::resource('blog_posts', BlogPostController::class);

    Route::resource('blog_tags', BlogTagController::class)->except('show');
});

require __DIR__.'/auth.php';
