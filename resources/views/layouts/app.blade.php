<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>:: Teatro ::</title>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {!!Html::style('template/assets/css/bootstrap.min.css')!!}
    {!!Html::style('template/assets/font-awesome/4.5.0/css/font-awesome.min.css')!!}
    {!!Html::style('template/assets/sweetalert2/sweetalert2.min.css')!!}
    {!!Html::style('template/assets/css/jquery.dataTables.min.css')!!}
    {!!Html::style('template/assets/css/responsive.dataTables.min.css')!!}
    {!!Html::script('template/assets/js/jquery-2.1.4.min.js')!!}
    {!!Html::script('template/assets/js/bootstrap.min.js')!!}
    {!!Html::script('template/assets/js/jquery.dataTables.min.js')!!}      
    {!!Html::script('template/assets/js/dataTables.responsive.min.js')!!}       
    {!!Html::script('template/assets/js/validator.min.js')!!}
    {!!Html::script('template/assets/sweetalert2/sweetalert2.min.js')!!}

</head>
<style type="text/css">
    .class_checkbox {
        width: 40px;  
        height: 40px;
        border-radius: 5px;
        background-color: red;
        opacity: 0.5; 
        background-image: url("template/assets/images/cinema.png");
        background-repeat: no-repeat;
        background-size: 30px 30px;
        background-position: center;
        cursor: pointer;
    }
    .class_checkbox.checked {
        background-color: green;
    }
</style>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    App - Reservaciones
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Hola <i class="fa fa-user"></i> {{ Auth::user()->name }} </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/usuarios') }}">
                                    <i class="fa fa-group"></i> Usuarios
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">
                                    <i class="fa fa-film"></i> Reservaciones
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>{{ __('Logout') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
