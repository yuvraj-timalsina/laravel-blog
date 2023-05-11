<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('posts')->get();
        return view('tag.index', compact('tags'));
    }

    public function create()
    {
        return view('tag.create');
    }

    public function store(CreateTagRequest $request)
    {
        Tag::create($request->validated());
        toastr()->success('Tag Created Successfully!');
        return to_route('tags.index');
    }

    public function edit(Tag $tag)
    {
        return view('tag.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        toastr()->success('Tag Updated Successfully!');
        return to_route('tags.index');
    }

    public function destroy(Tag $tag)
    {
        if ($tag->posts->count()) {
            toastr()->warning('Tag has ' . $tag->posts->count() . ' posts!', 'Cannot Delete Tag!');
            return back();
        }
        $tag->delete();
        toastr()->error('Tag Deleted Successfully!');
        return to_route('tags.index');
    }
}
