<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Http\Traits\FetchCategory;
use App\Http\Traits\FetchTag;
use App\Http\Traits\FetchTrashPost;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use FetchCategory, FetchTag, FetchTrashPost;
    /**
     * Apply categories count middleware.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('VerifyCategoriesCount')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::whereBelongsTo(Auth::user())->with('category', 'tags')->get();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->fetchCategory();
        $tags = $this->fetchTag();
        return view('post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $image = $request->featured_image->store('posts');

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'featured_image' => $image,
        ]);

        $attachableTags = [];
        foreach ($request->tags as $tag) {
            $attachableTags[] = Tag::firstOrCreate([
                'name' => $tag
            ])->id;
        }
        $post->tags()->sync($attachableTags);

        toastr()->success('Post Created Successfully!');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
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
                'name' => $tag
            ])->id;
        }
        $post->tags()->sync($attachableTags);
        /** redirect user to index page */
        toastr()->success('Post Updated Successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
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
            return redirect(route('posts.trash'));
        } else {

            /** move post to trash */
            $post->delete();
        }

        toastr()->success('Post Trashed Successfully!');
        return redirect(route('posts.index'));
    }

    /**
     * Display the list of trashed posts.
     *
     * @return \Illuminate\Http\Response
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
        return back();
    }
}
