<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\Tag;
    use App\Models\Post;
    use App\Models\Category;
    
    class WelcomeController extends Controller
    {
        public function index()
        {
            $search = request()->query('search');
            $posts = Post::with('category');
            
            if ($search) {
                $posts = $posts->where('title', 'LIKE', "%{$search}%")->simplePaginate(4);
            }
            else {
                $posts = $posts->simplePaginate(4);
            }
            
            return view('welcome', [
                'categories' => Category::all(),
                'tags' => Tag::all(),
                'posts' => $posts,
                'search' => $search,
            ]);
        }
    }
