<!-- NAVBAR -->
<nav id="navbar__bg" class="navbar navbar-expand navbar sticky-top bg-white pl-5" >
    <a class="navbar-brand navbar__logo"><img class="navbar__logo--img" src="{{ asset('img/konti_logo.png') }}" alt="konti-tracker logo"></a>
        <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item active">
                    <a class="nav-link navbar__link hover__black" data-toggle="modal" data-target="#loginmodal">Login</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item active">
                        <a class="nav-link navbar__link hover__black text-center" href="{{ route('register') }}">Register <span class="sr-only">(current)</span></a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{ route('dashboard.index') }}">Dashboard</a>
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
</nav>
