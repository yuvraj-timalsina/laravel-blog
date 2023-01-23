<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome')->name('index');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/trash-posts', [PostController::class, 'trash'])->name('posts.trash');
    Route::put('/restore-post/{post}', [PostController::class, 'restore'])->name('posts.restore');
    Route::resources([
        'categories' => CategoryController::class,
        'tags' => TagController::class,
        'posts' => PostController::class,
    ]);
    Route::get('home', [HomeController::class, 'index'])->name('home');
});

Route::controller(UserController::class)->middleware(['auth', 'admin'])
    ->prefix('users')->group(function () {
        Route::get('/', 'index')->name('users.index');
        Route::post('{user}/make-admin', 'makeAdmin')->name('users.make-admin');
        Route::get('profile', 'edit')->name('users.edit-profile');
    });