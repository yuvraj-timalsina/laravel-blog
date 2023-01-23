@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.index') }}" class="btn btn-info">{{ __('Go Back') }}</a>
    </div>
    <div class="card">
        <div class="card-header">{{ __('Trashed Posts') }}</div>

        <div class="card-body">
            @if ($posts->count() > 0)
                <table class="table align-middle">
                    <thead>

                        <tr>
                            <th>S.N.</th>
                            <th>Featured Image</th>
                            <th>Category</th>
                            <th>Tag</th>
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
                                    <div class="d-flex">
                                        <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-info me-1">Restore</button>
                                        </form>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center">
                    <img src="{{ asset('media/no-data.png') }}" alt="" width="225px">
                    <h3>No Trashed Posts!</h3>
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
