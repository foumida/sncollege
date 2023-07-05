<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MES ASMABI</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('theme/admin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/admin/assets/vendors/css/vendor.bundle.base.css')}}">

    <link rel="stylesheet" href="{{asset('theme/admin/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('theme/admin/assets/images/favicon.png')}}">
    <!-- Scripts 
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])-->
</head>
<body>
    <div id="app">
     
            <div class="container">
                
               
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                 
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                           
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
                        @endguest
                    </ul>
                </div>
            </div>
        
        <main>
            @yield('content')
        </main>
    </div>
    
 <!-- plugins:js -->
    <script src="{{asset('theme/admin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/misc.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/settings.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/todolist.js')}}"></script>   
    
</body>
</html>
