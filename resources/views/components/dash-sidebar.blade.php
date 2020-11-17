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
                <a href="#" class=" text-white sidebar__name">{{ auth()->user()->name }}</a>
                <p class="sidebar__text mb-0 ">{{ auth()->user()->profile->position }}</p>
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
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="dashboard/calendar" class=" sidebar__link hover__black">
                        <svg class="icons icons--sidebar">
                            <use href="{{ asset('svg/sprite.svg#icon-calendar') }}"></use>
                        </svg>
                        <span>Calendar</span>
                    </a>
                </li>
                <li>
                    <a href="notifications.html" class=" sidebar__link hover__black">
                        <svg class="icons icons--sidebar">
                            <use href="{{ asset('svg/sprite.svg#icon-bell') }}"></use>
                        </svg>
                        <span>Notifications</span>
                    </a>
                </li>
                <li>
                    <a href="pto.html" class=" sidebar__link hover__black">
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
