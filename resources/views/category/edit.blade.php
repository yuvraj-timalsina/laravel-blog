@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('categories.index') }}" class="btn btn-info">{{ __('Go Back') }}</a>
    </div>
    <div class="card">
        <div class="card-header">{{ __('Edit Category') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ $category->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </form>
        </div>
    </div>
@endsection
