<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    
    <title>
        @yield('title')
    </title>
    
    <!-- Styles -->
    <link href="{{asset('css/page.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
    
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
</head>

<body>
    
    
    <!-- Navbar -->
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
    
    @yield('header')
    
    @yield('content')
    
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row gap-y align-items-center">
                
                <div class="col-6 col-lg-6">
                    <a href="{{route('welcome')}}"><img src="{{ asset('img/logo-dark.png') }}" alt="logo"></a>
                </div>
                
                <div class="col-6 col-lg-6 text-right order-lg-last">
                    <div class="social">
                        <a class="social-facebook" href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                        <a class="social-twitter" href="https://twitter.com/"><i class="fa fa-twitter"></i></a>
                        <a class="social-instagram" href="https://www.instagram.com//"><i class="fa fa-instagram"></i></a>
                        <a class="social-dribble" href="https://dribbble.com/"><i class="fa fa-dribble"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- /.footer -->
    
    
    <!-- Scripts -->
    <script src="{{ asset('js/page.min.js') }}s"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
