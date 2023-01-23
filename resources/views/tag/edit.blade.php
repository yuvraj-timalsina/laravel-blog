@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('tags.index') }}" class="btn btn-info">{{ __('Go Back') }}</a>
    </div>
    <div class="card">
        <div class="card-header">{{ __('Edit Tag') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('tags.update', $tag->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Tag Name</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ $tag->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Tag</button>
            </form>
        </div>
    </div>
@endsection
