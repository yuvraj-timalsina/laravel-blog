<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\Tag;
    use App\Models\Post;
    use App\Models\Category;
    
    class WelcomeController extends Controller
    {
        public function index()
        {
            return view('welcome', [
                'categories' => Category::all(),
                'tags' => Tag::all(),
                'posts' => Post::with('category')->get(),
            ]);
        }
    }
