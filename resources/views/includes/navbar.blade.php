<nav class="navbar navbar-expand-md navbar-light container" id="navbar">
    <a class=" navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <div class="logo mb-1">
            <img src="https://cdn.discordapp.com/attachments/1090199171568500760/1091310054222864464/logo_deliverboo_100x250.png" class="img" alt="">
        </div>
        {{-- config('app.name', 'Laravel') --}}
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav d-none d-md-flex">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link btn-cust-1" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link btn-cust-2" href="{{ route('register') }}">{{ __('Registrati') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('dashboard') }}">{{__('Dashboard')}}</a>
                    <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
</nav>