@extends('layouts.blog')
@section('title')
    Category - {{ $category->name }}
@endsection
<nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
    <div class="container">
        
        <div class="navbar-left">
            <button class="navbar-toggler" type="button">&#9776;</button>
            <a class="navbar-brand" href="{{route('welcome')}}">
                <img class="logo-dark" src="{{ asset('img/logo-dark.png') }}" alt="logo">
                <img class="logo-light" src="{{ asset('img/logo-light.png') }}" alt="logo">
            </a>
        </div>
        @auth
            <a class="btn btn-xs btn-round btn-success" href="{{route('dashboard')}}">Dashboard</a>
        @endauth
        @guest
            <a class="btn btn-xs btn-round btn-success" href="{{route('login')}}">Login</a>
        @endguest
    
    </div>
</nav><!-- /.navbar -->
@section('header')
    <header class="header text-center text-white" style="background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <h1>
                        {{ $category->name }}
                    </h1>
                    <p class="lead-2 opacity-90 mt-6">Read and get updated on how we progress</p>
                
                </div>
            </div>
        
        </div>
    </header>
@endsection
@section('content')
    <main class="main-content">
        <div class="section bg-gray">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-8 col-xl-9">
                        <div class="row gap-y">
                            @forelse($posts as $post)
                                <div class="col-md-6">
                                    <div class="card border hover-shadow-6 mb-6 d-block">
                                        <a href="{{route('blog.show', $post)}}"><img class="card-img-top" src="{{ $post->featured_image }}" alt="{{ $post->title }}"></a>
                                        <div class="p-6 text-center">
                                            <p><a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="#">{{ $post->category->name }}</a></p>
                                            <h5 class="mb-0"><a class="text-dark" href="{{route('blog.show', $post)}}">{{ $post->title }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">
                                     No result found for query <strong>{{request()->query('search')}}</strong>.
                                </p>
                            @endforelse
                        
                        </div>
                        {{ $posts->appends(['search'=>request()->query('search')])->links() }}
                    </div>
                    
                    
                @include('partials.sidebar')
                
                </div>
            </div>
        </div>
    </main>
@endsection
