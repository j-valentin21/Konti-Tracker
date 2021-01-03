<!-- ========== NAV BAR ========== -->
<nav class="dashboard__nav">
        <div class="navbar__dash">
            <div class="ml-4">
                <a class="navbar__dash__logo navi"  href="/">
                    <img src="{{ asset('img/konti_logo.png') }}" alt="Konti-Tracker logo" height="80">
                </a>
                <menu-btn></menu-btn>
            </div>
            <div class="navbar__links justify-content-end">
                <div class="navbar__icon-container">
                    @if($profile)
                        <svg class="icon__nav icon__nav-animation  mt-2">
                            <use href="{{ asset('svg/sprite.svg#icon-bell2') }}"></use>
                        </svg>
                        <span class="badge__count" data-count="10"> </span>
                    @else
                        <svg class="icon__nav mt-2">
                            <use href="{{ asset('svg/sprite.svg#icon-bell2') }}"></use>
                        </svg>
                    @endif
                </div>
                <!-- ========== NAVBAR IMAGE DROPDOWN ========== -->
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(isset(auth()->user()->profile->avatar))
                        <img class="rounded-circle navbar__img d-xl-inline-block"
                             src="{{ Storage::disk('s3')->url(auth()->user()->profile->avatar) }}"
                             alt="user image">
                    @else
                        <img class="rounded-circle navbar__img d-xl-inline-block"
                             src="{{ asset('img/user_placeholder.jpg')}}"
                             alt="user image">
                    @endif
                        <span class="text-white d-none d-xl-inline-block ml-1">{{ auth()->user()->name }}</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dashboard__card dashboard__card__dropdown">
                        <a class="dropdown-item dashboard__card__text hover__black mb-1" href="{{ route('dashboard.profile.index') }}">
                            <svg class="icons">
                                <use href="{{ asset('svg/sprite.svg#icon-user') }}"></use>
                            </svg> Profile
                        </a>
                        <a class="dropdown-item dashboard__card__text hover__black mb-1" href="{{ route('dashboard.PTOPoints.index') }}">
                            <svg class="icons">
                                <use href="{{ asset('svg/sprite.svg#icon-chart-bar-outline') }}"></use>
                            </svg> PTO/Points Data
                        </a>
                        <a class="dropdown-item dashboard__card__text hover__black mb-1" href="{{ route('dashboard.password.index') }}">
                            <svg class="icons">
                                <use href="{{ asset('svg/sprite.svg#icon-key-outline') }}"></use>
                            </svg> Change Password
                        </a>
                        <a class="dropdown-item dashboard__card__text hover__black mb-1"
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            <svg class="icons">
                                <use href="{{ asset('svg/sprite.svg#icon-switch') }}"></use>
                            </svg> {{ __('Logout') }}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </div>
                </div>
            </div>
            <!-- LOGO/MENU -->
        </div>
    <!-- NAVBAR TITLE -->
    <div class="navbar__title">
        <div class="d-flex justify-content-lg-center justify-content-start">
            <h4 class="ml-4 text-white">@yield('content')</h4>
        </div>
    </div>
</nav>
