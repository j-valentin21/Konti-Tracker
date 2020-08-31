<!-- ========== NAV BAR ========== -->
<nav class="dashboard__nav">
    <div class="navbar__dash">
        <div class="container-fluid">
            <div class="float-right mt-3">
                <!-- ========== NAVBAR IMAGE DROPDOWN ========== -->
                <div class="dropdown d-inline-block mr-4">
                    <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle navbar__img d-xl-inline-block" src="{{ asset('img/vacation.jpg') }}" alt="user image">
                        <span class="text-white d-none d-xl-inline-block ml-1">Joel</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dashboard__card">
                        <a class="dropdown-item dashboard__card__text hover__black" href="#">
                            <svg class="icons">
                                <use href="svg/sprite.svg#icon-user"></use>
                            </svg> Profile
                        </a>
                        <a class="dropdown-item d-block dashboard__card__text hover__black" href="#">
                            <svg class="icons">
                                <use href="svg/sprite.svg#icon-cog"></use>
                            </svg> Settings
                        </a>
                        <a class="dropdown-item dashboard__card__text hover__black" href="#">
                            <svg class="icons">
                                <use href="svg/sprite.svg#icon-switch"></use>
                            </svg> Logout
                        </a>
                    </div>
                </div>
            </div>
            <!-- LOGO/MENU -->
            <div class="ml-4">
                <a class="navbar__dash__logo"  href="index.html">
                    <img src="{{ asset('img/konti_logo.png') }}" alt="Konti-Tracker logo" height="80">
                </a>
                <div class="navbar__menu d-lg-none" data-toggle="collapse" data-target="#sidebar-menu">
                    <span class="navbar__menu__global navbar__menu__global--top"></span>
                    <span class="navbar__menu__global navbar__menu__global--middle"></span>
                    <span class="navbar__menu__global navbar__menu__global--bottom"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- NAVBAR TITLE -->
    <div class="navbar__title">
        <div class="d-flex justify-content-lg-center justify-content-start">
            <h4 class="ml-4 text-white">DASHBOARD</h4>
        </div>
    </div>
</nav>