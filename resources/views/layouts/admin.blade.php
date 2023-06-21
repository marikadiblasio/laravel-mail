<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Boolfolio Project Typology' }}</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="ms-small-square">
                        <img class="my-logo-img" src="/images/logo.png" alt="logo">
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        {{-- @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif --}}
                        {{-- @else --}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/admin') }}">{{ __('Dashboard') }}</a>
                                {{-- <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a> --}}
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        {{-- @endguest --}}
                    </ul>
                </div>
            </div>
        </nav>

        <div class="d-flex ms-wrapper bg-dark">
            {{-- SIDEBAR ADMIN --}}
            <nav id="ms-sidebar" class="pt-4 text-white d-flex flex-column flex-shrink-0 h-100">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" role="button" aria-current="page" href="{{route('admin.dashboard')}}"><i
                                class="fa-solid me-1 fa-house"></i><span class="d-none d-md-inline">{{ __('Home')}}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" role="button"
                            href="{{ route('admin.projects.index') }}">
                            <i class="fa-solid me-1 fa-code"></i>
                            <span class="d-none d-md-inline">Projects</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" role="button"
                            href="{{ route('admin.types.index') }}"><i class="fa-solid me-1 fa-tag"></i><span
                                class="d-none d-md-inline">Type</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" role="button"
                            href="{{ route('admin.technologies.index') }}"><i class="fa-solid me-1 fa-tag"></i><span
                                class="d-none d-md-inline">Technology</span></a>
                    </li>
                </ul>
                <ul class="ms-h120px mt-auto nav ">
                    <li class="nav-item">
                        <a class="nav-link text-white" role="button" aria-current="page" href="#"><i
                                class="fa-solid me-1 fa-gear"></i><span class="d-none d-md-inline">Admin</span></a>
                    </li>
                </ul>
            </nav>
            {{-- NAVBAR SUPERIORE - HEADER --}}
            <div class="overflow-y-auto flex-grow-1 ms-wrapper">
                <div id="aside" class="bg-dark-blue text-white">
                    <div class="container-fluid pb-4">
                        <div class="row justify-content-between">
                            <div class="col-12 col-sm-4 col-lg-2 mt-4 order-lg-3">
                                <span>Add Project</span>
                                <a type="button" href="{{ route('admin.projects.create') }}"
                                    class="btn btn-lg btn-outline-light ms-2">+</a>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-6 mt-4 order-lg-1">
                                <h2 class="display-6 fw-medium">BoolFolio
                                    Project Technology <span>
                            </div>
                            {{-- <div class="col-12 col-sm-4 col-lg-4 mt-4 mb-4 lh-lg order-lg-2">
                                <span>Visitatori online</span>
                                <div><span class="display-6">2</span></div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <main class="">
                    @yield('content')
                </main>
            </div>
        </div>

    </div>
</body>

</html>
