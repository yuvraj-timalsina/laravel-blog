@extends('layouts.blog')

@section('title')
    {{$post->title}}
@endsection

@section('header')
    <header class="header text-white h-fullscreen pb-80" style="background-image: url({{ asset('/storage/'. $post->featured_image) }});" data-overlay="9">
        <div class="container text-center">
            
            <div class="row h-100">
                <div class="col-lg-8 mx-auto align-self-center">
                    
                    <p class="opacity-70 text-uppercase small ls-1">
                        {{$post->category->name}}
                    </p>
                    <h1 class="display-4 mt-7 mb-8">
                        {{$post->title}}
                    </h1>
                    <p><span class="opacity-70 mr-1">By</span> <a class="text-white" href="#">
                            {{$post->user->name}}
                        </a></p>
                    <p><img class="avatar avatar-sm" src="https://ui-avatars.com/api/?name={{$post->user->name}}&background=random" alt="..."></p>
                
                </div>
                
                <div class="col-12 align-self-end text-center">
                    <a class="scroll-down-1 scroll-down-white" href="#section-content"><span></span></a>
                </div>
            
            </div>
        
        </div>
    </header>
@endsection

@section('content')
    <main class="main-content">
        
        <div class="section" id="section-content">
            <div class="container">
                {!! $post->content !!}
                <div class="row">
                    <div class="gap-xy-2 mt-6">
                        @foreach($post->tags as $tag)
                            <a class="badge badge-pill badge-secondary" href="#">
                                {{$tag->name}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        
        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Comments
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <div class="section bg-gray">
            <div class="container">
                
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        
                        <hr>
                        <div id="disqus_thread"></div>
                        <script>
                             var disqus_config = function () {
                             this.page.url = "{{url()->current()}}";
                             this.page.identifier = {{$post->id}};
                             };
                             
                            (function () {
                                var d = document, s = d.createElement('script');
                                s.src = 'https://blog-website-7.disqus.com/embed.js';
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    
                    </div>
                </div>
            
            </div>
        </div>
    
    
    </main>
@endsection