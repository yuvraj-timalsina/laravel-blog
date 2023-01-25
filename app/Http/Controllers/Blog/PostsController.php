<?php
    
    namespace App\Http\Controllers\Blog;
    
    use App\Models\Tag;
    use App\Models\Post;
    use App\Models\Category;
    use App\Http\Controllers\Controller;
    
    class PostsController extends Controller
    {
        public function show(Post $post)
        {
            return view('blog.show', ['post' => $post]);
        }
        
        
        public function category(Category $category)
        {
            return view('blog.category', [
                'category' => $category,
                'posts' => $category->posts()->with('category')->latest()->searched()->simplePaginate(4),
                'categories' => Category::all(),
                'tags' => Tag::all(),
            ]);
        }
        
        
        public function tag(Tag $tag)
        {
            return view('blog.tag', [
                'tag' => $tag,
                'posts' => $tag->posts()->latest()->searched()->simplePaginate(4),
                'tags' => Tag::all(),
                'categories' => Category::all(),
            ]);
        }
    }
