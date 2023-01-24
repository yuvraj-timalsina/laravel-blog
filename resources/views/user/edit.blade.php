@extends('layouts.app')

@section('content')
    <div class="card mt-5">
        <div class="card-header">{{ __('My Profile') }}</div>

        <div class="card-body">
           <form action="{{route('users.edit-profile')}}" method="POST">
               @csrf
               @method('PUT')
               <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ $user->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
               
                <div class="mb-3">
                    <label for="bio" class="form-label">About Me</label>
                  <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" id="bio" rows="3">{{ $user->bio }}</textarea>
                    @error('bio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
           </form>
        </div>
    </div>
@endsection
