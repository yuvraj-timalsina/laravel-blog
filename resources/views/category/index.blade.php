@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('categories.create') }}" class="btn btn-success">Create Category</a>
    </div>
    <div class="card">
        <div class="card-header">{{ __('All Categories') }}</div>

        <div class="card-body">
            @if ($categories->count() > 0)
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Category Name</th>
                            <th>Posts Count</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{!! $category->name !!}</td>
                                <td>{{ $category->posts_count }}</td>
                                <td>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-info">Edit</a>
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <div class="text-center">
                    <img src="{{ asset('media/no-data.png') }}" alt="" width="225px">
                    <h3>No Categories Yet!</h3>
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
