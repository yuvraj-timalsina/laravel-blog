<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\Tag;
    use App\Models\Post;
    use Illuminate\Http\Request;
    use App\Http\Traits\FetchTag;
    use Illuminate\Http\Response;
    use App\Http\Traits\FetchCategory;
    use App\Http\Traits\FetchTrashPost;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Requests\Posts\CreatePostRequest;
    use App\Http\Requests\Posts\UpdatePostRequest;
    
    class PostController extends Controller
    {
        use FetchCategory, FetchTag, FetchTrashPost;
        
        /**
         * Apply categories count middleware.
         *
         * @return Response
         */
        public function __construct()
        {
            $this->middleware('VerifyCategoriesCount')->only(['create', 'store']);
        }
        
        
        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            $posts = Post::whereBelongsTo(Auth::user())->with('category', 'tags')->get();
            
            return view('post.index', compact('posts'));
        }
        
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param Post $post
         * @return Response
         */
        public function edit(Post $post)
        {
            if ($post->user_id != auth()->id()) {
                return abort(403);
            }
            $categories = $this->fetchCategory();
            $tags = $this->fetchTag();
            
            return view('post.edit', compact('post', 'categories', 'tags'));
        }
        
        
        /**
         * Update the specified resource in storage.
         *
         * @param Request $request
         * @param Post $post
         * @return Response
         */
        public function update(UpdatePostRequest $request, Post $post)
        {
            $data = $request->safe()->except(['featured_image']);
            /** check if post has image */
            if ($request->hasFile('featured_image')) {
                /** upload new image */
                $image = $request->featured_image->store('posts');
                /** delete old image */
                $post->deleteImage();
                $data['featured_image'] = $image;
            }
            
            $post->update($data);
            
            $attachableTags = [];
            foreach ($request->tags as $tag) {
                $attachableTags[] = Tag::firstOrCreate([
                    'name' => $tag,
                ])->id;
            }
            $post->tags()->sync($attachableTags);
            /** redirect user to index page */
            toastr()->success('Post Updated Successfully!');
            
            return to_route('posts.index');
        }
        
        
        /**
         * Store a newly created resource in storage.
         *
         * @param Request $request
         * @return Response
         */
        public function store(CreatePostRequest $request)
        {
            $post = $request->safe()->except('featured_image') + ['user_id' => auth()->id()];
            if ($request->hasFile('featured_image')) {
                $post['featured_image'] = $request->featured_image->store('posts');
            }
            
            $post = Post::create($post);
            
            $attachableTags = [];
            foreach ($request->tags as $tag) {
                $attachableTags[] = Tag::firstOrCreate([
                    'name' => $tag,
                ])->id;
            }
            $post->tags()->sync($attachableTags);
            
            toastr()->success('Post Created Successfully!');
            
           return to_route('posts.index');
        }
        
        
        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {
            $categories = $this->fetchCategory();
            $tags = $this->fetchTag();
            
            return view('post.create', compact('categories', 'tags'));
        }
        
        
        /**
         * Remove the specified resource from storage.
         *
         * @param Post $post
         * @return Response
         */
        public function destroy($id)
        {
            /** find the post */
            $post = $this->fetchTrashPost($id);
            /** check if the post is trashed */
            if ($post->trashed()) {
                
                /** delete image from storage */
                $post->deleteImage();
                
                /** delete post permanently */
                $post->forceDelete();
                
                /** redirect user to trash page */
                toastr()->success('Post Deleted Successfully!');
                
                return to_route('posts.trash');
            }
            else {
                
                /** move post to trash */
                $post->delete();
            }
            
            toastr()->success('Post Trashed Successfully!');
            
            return to_route('posts.trash');
        }
        
        
        /**
         * Display the list of trashed posts.
         *
         * @return Response
         */
        public function trash()
        {
            $posts = Post::whereBelongsTo(Auth::user())->with('category', 'tags')->onlyTrashed()->get();
            
            return view('post.trash', compact('posts'));
        }
        
        
        /**
         * Restore the trashed post.
         *
         * @return void
         */
        public function restore($id)
        {
            $this->fetchTrashPost($id)->restore();
            toastr()->success('Post Restored Successfully!');
            
            return to_route('posts.index');
        }
    }
