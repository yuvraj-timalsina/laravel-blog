<?php

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.show', ['post' => $post]);
    }
}
