<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                       
                    {{-- @endif --}}
                </ul>

                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    {{-- <script type="text/javascript">
                        window.location.href = "{{ route('/') }}";
                    </script> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @else
                        @if(Auth::user()->role === 'Admin')
                            <!-- Admin Role -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>                           
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('agent.viewAll') }}">Agents</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customer.viewAll') }}">Customers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('claims.index') }}">Claims</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('policies.index') }}">Policies</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Masters <span class="caret"></span>
                                </a>
                            
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- <form action="{{ route('masters.group') }}" method="POST">
                                        @csrf <button type="submit" class="dropdown-item">Group Master</button>
                                    </form> --}}
                                    <a class="dropdown-item" href="{{ route('register', ['role' => 'agent']) }}">Agent Master</a>
                                    <a class="dropdown-item" href="{{ route('register', ['role' => 'customer']) }}">Customer Master</a>
                                    <a class="dropdown-item" href="{{ route('masters.index', ['option' => 'groups']) }}">Group Master</a>
                                    <a class="dropdown-item" href="{{ route('masters.index', ['option' => 'insuranceCompanies']) }}">Insurance Company Master</a>
                                    <a class="dropdown-item" href="{{ route('masters.index', ['option' => 'policy']) }}">Policy Master</a>
                                    <a class="dropdown-item" href="{{ route('masters.index', ['option' => 'policyTypes']) }}">Policy Type Master</a>
                                    <a class="dropdown-item" href="{{ route('masters.index', ['option' => 'banks']) }}">Bank Master</a>
                                    
                                </div>
                                
                            </li>
                        @endif
                    
                        <!-- Agent Role -->
                        @if(Auth::user()->role === 'Agent')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customer.viewAll') }}">Customers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('claims.index') }}">Claims</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('policies.index') }}">Policies</a>
                            </li>
                        @endif
                    
                        <!-- Customer Role -->
                        @if(Auth::user()->role === 'Customer')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('policies.index') }}">Policies</a>
                            </li>
                        @endif
                    
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body></html>