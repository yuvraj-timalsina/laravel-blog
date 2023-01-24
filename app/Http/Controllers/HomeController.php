<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'users_count' => User::count(),
            'posts_count' => Post::count(),
            'categories_count' => Category::count(),
            'trash_posts_count'=> Post::onlyTrashed()->count()]);
    }
}