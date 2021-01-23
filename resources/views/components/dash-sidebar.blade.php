<div class="sidebar d-lg-block collapse" id="sidebar-menu">
    <div class="h-100 m-3">
        <!-- ========== SIDEBAR HEADER ========== -->
        <div class="text-center py-4">
            <div class="sidebar__img">
                @if(isset(auth()->user()->profile->avatar))
                    <img src="{{ Storage::disk('s3')->url(auth()->user()->profile->avatar) }}"
                         alt="user image"
                         class="sidebar__avatar mx-auto rounded-circle">
                @else
                    <img src="{{ asset('img/user_placeholder.jpg') }}"
                         alt="user image"
                         class="sidebar__avatar mx-auto rounded-circle">
                @endif
            </div>
            <div class="mt-3 break-word">
                <a href="#" class=" text-white sidebar__name">{{ auth()->user()->name  ?? "" }}</a>
                <p class="sidebar__text mb-0 ">{{ auth()->user()->profile->position ?? "" }}</p>
                <p class="sidebar__text"> Date of employment:</p>
                <span class="sidebar__text">{{ date('m-d-Y', strtotime(auth()->user()->profile->date_of_employment))  ?? "" }}</span>
            </div>
        </div>
        <!-- ========== SIDEBAR MENU ========== -->
        <div>
            <ul class=" list-unstyled">
                <li class="sidebar__menu">Menu</li>
                <li>
                    <a href="{{ route('dashboard.index') }}" class=" sidebar__link hover__black">
                        <svg class="icons icons--sidebar">
                            <use href="{{ asset('svg/sprite.svg#icon-home3') }}"></use>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('calendar.index') }}" class=" sidebar__link hover__black">
                        <svg class="icons icons--sidebar">
                            <use href="{{ asset('svg/sprite.svg#icon-calendar') }}"></use>
                        </svg>
                        <span>Calendar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.weather.index') }}" class=" sidebar__link hover__black">
                        <svg class="icons icons--sidebar pr-1">
                            <use href="{{ asset('svg/sprite.svg#icon-weather-cloudy') }}"></use>
                        </svg>
                        <span class="">Weather</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.activity.index') }}" class="sidebar__link hover__black">
                        <svg class="icons icons--sidebar">
                            <use href="{{ asset('svg/sprite.svg#icon-device-desktop') }}"></use>
                        </svg>
                        <span>Dashboard Activity</span>
                    </a>
                </li>
                <li>
                    <a data-toggle="modal" href="#request-modal" class=" sidebar__link hover__black">
                        <svg class="icons icons--sidebar">
                            <use href="{{ asset('svg/sprite.svg#icon-airplane') }}"></use>
                        </svg>
                        <span>Request PTO day</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
