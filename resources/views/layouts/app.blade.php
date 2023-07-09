<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Тех.підтримка') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.tiny.cloud/1/your-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ route('home') }}">
                    Головна
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    <nav class="navbar navbar-expand-lg navbar-light bg-primary text-white">
                        <div class="collapse navbar-collapse text-white" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto text-white">
                                @if(Auth::check())
                                    <?php $user = Auth::user(); ?>
                                    @if($user->access_level == 'Admin')
                                        <li class="nav-item"><a href="{{ route('tickets') }}" class="nav-link text-white">Мої звернення</a></li>
                                        <li class="nav-item"><a href="{{ route('new') }}" class="nav-link text-white">Створити звернення</a></li>
                                        <li class="nav-item"><a href="{{ route('support_agent.index')}}" class="nav-link text-white">Останні звернення</a></li>
                                        <li class="nav-item"><a href="{{ route('agentIndex')}}" class="nav-link text-white">Я відповів</a></li>
                                        <li class="nav-item"><a href="{{ route('access') }}" class="nav-link text-white">Керування користувачами</a></li>
                                        <li class="nav-item"><a href="{{ route('answeredIndex') }}" class="nav-link text-white">Перегляд відповідей агентів</a></li>
                                    @elseif($user->access_level == 'Senior Agent')
                                        <li class="nav-item"><a href="{{ route('tickets') }}" class="nav-link text-white">Мої звернення</a></li>
                                        <li class="nav-item"><a href="{{ route('new') }}" class="nav-link text-white">Створити звернення</a></li>
                                        <li class="nav-item"><a href="{{ route('support_agent.index')}}" class="nav-link text-white">Останні звернення</a></li>
                                        <li class="nav-item"><a href="{{ route('agentIndex')}}" class="nav-link text-white">Я відповів</a></li>
                                        <li class="nav-item"><a href="{{ route('access') }}" class="nav-link text-white">Керування користувачами</a></li>
                                        <li class="nav-item"><a href="{{ route('answeredIndex') }}" class="nav-link text-white">Перегляд відповідей агентів</a></li>
                                    @elseif($user->access_level == 'Agent')
                                        <li class="nav-item"><a href="{{ route('tickets') }}" class="nav-link text-white">Мої звернення</a></li>
                                        <li class="nav-item"><a href="{{ route('new') }}" class="nav-link text-white">Створити звернення</a></li>
                                        <li class="nav-item"><a href="{{ route('support_agent.index')}}" class="nav-link text-white">Останні звернення</a></li>
                                        <li class="nav-item"><a href="{{ route('agentIndex')}}" class="nav-link text-white">Я відповів</a></li>
                                    @else
                                        <li class="nav-item"><a href="{{ route('tickets') }}" class="nav-link text-white">Мої звернення</a></li>
                                        <li class="nav-item"><a href="{{ route('new') }}" class="nav-link text-white">Створити звернення</a></li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </nav>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Вхід') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Реєстрація') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Вихід') }}
                                        
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
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
</html>
