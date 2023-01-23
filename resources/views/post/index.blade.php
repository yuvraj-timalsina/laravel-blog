@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
    </div>
    <div class="card">
        <div class="card-header">{{ __('All Posts') }}</div>
        <div class="card-body">
            @if ($posts->count() > 0)
                <table class="table align-middle">
                    <thead>

                        <tr>
                            <th>S.N.</th>
                            <th>Featured Image</th>
                            <th>Category</th>
                            <th>Tags</th>
                            <th>Post Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>
                                    <img src="{{ asset('/storage/' . $post->featured_image) }}" alt="" width="65px">
                                </td>
                                <td><a
                                        href="{{ route('categories.edit', $post->category_id) }}">{!! $post->category->name !!}</a>
                                </td>
                                <td>
                                    @foreach ($post->tags as $tag)
                                        <a href="{{ route('tags.edit', $tag->id) }}"><span
                                                class="badge bg-primary">{{ $tag->name }}</span></a>
                                    @endforeach
                                </td>
                                <td>{!! $post->title !!}</td>
                                <td>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <button type="submit" class="btn btn-sm btn-danger">Trash</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center">
                    <img src="{{ asset('media/no-data.png') }}" alt="" width="225px">
                    <h3>No Posts Yet!</h3>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
@endsection
