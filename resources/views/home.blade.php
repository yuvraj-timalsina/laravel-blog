@extends('layouts.app')

@section('content')
    <div class="row mt-5">
          <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    Total Users
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        {{ $users_count }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-center bg-success text-white">
                   Published Posts
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        {{ $posts_count }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-center bg-info text-white">
                    Categories
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        {{ $categories_count }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-center bg-danger text-white">
                    Trashed Posts
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        {{ $trash_posts_count }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
@endsection
