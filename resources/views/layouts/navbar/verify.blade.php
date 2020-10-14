<!-- ========== NAV BAR ========== -->
<nav class="auth__nav">
    <div class="container-fluid">
        <div class="float-right">
            <!-- ========== NAVBAR IMAGE DROPDOWN ========== -->
            <div class="nav-item dropdown auth__links">
                <a id="navbarDropdown"
                   class="nav-link dropdown-toggle"
                   role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
                    <x-logout></x-logout>
                </div>
            </div>
        </div>
        <!-- LOGO/MENU -->
        <div class="ml-4">
            <a class="navbar__dash__logo"  href="/">
                <img src="{{ asset('img/konti_logo.png') }}" alt="Konti-Tracker logo" height="80">
            </a>
            <menu-btn></menu-btn>
        </div>
    </div>
</nav>
