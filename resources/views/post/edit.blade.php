@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.index') }}" class="btn btn-info">{{ __('Go Back') }}</a>
    </div>
    <div class="card">
        <div class="card-header">{{ __('Edit Post') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <img src="{{ asset('/storage/' . $post->featured_image) }}" alt="" width="225px" id="previewImg">
                </div>
                <div class="mb-3">
                    <label for="featured_image" class="form-label">Featured Image</label>
                    <input name="featured_image" class="form-control @error('featured_image') is-invalid @enderror"
                        type="file" id="featured_image" onchange="preview()">
                    @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category_id" class="form-select @error('category') is-invalid @enderror" id="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($category->id == $post->category_id) selected @endif>
                                {!! $category->name !!}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <select class="form-select tags @error('tags') is-invalid @enderror" name="tags[]" multiple="multiple"
                        id="tags">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->name }}" @if ($post->hasTag($tag->name)) selected @endif>
                                {{ $tag->name }}</option>
                        @endforeach
                    </select>
                    @error('tags')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        value="{!! $post->title !!}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <input id="content" type="hidden" name="content" class="@error('content') is-invalid @enderror"
                        value="{{ $post->content }}">
                    <trix-editor input="content"></trix-editor>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tags').select2({
                tags: true,
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <script>
        function preview() {
            previewImg.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" />
@endsection
