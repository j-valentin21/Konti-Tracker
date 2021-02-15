<!-- FOOTER -->
<div class="container-fluid">
    <footer class="footer d-flex flex-wrap align-content-end">
        <div class="container">
            <h2 class="footer__primary text-center mt-4">SITE LINKS</h2>
            <div class="d-flex justify-content-around">
                @guest
                    <a class="footer__link hover__black" href="#">HOME</a>
                    <a class="footer__link hover__black" href="{{ route('register') }}">REGISTER</a>
                    <a class="footer__link hover__black" data-toggle="modal" data-target="#loginmodal">SIGN IN</a>
                    <a class="footer__link hover__black" href="{{ route('contact-us') }}">CONTACT US</a>
                @else
                    <a class="footer__link hover__black" href="#">HOME</a>
                    <a class="footer__link hover__black" href="{{ route('dashboard.index') }}">DASHBOARD</a>
                    <a class="footer__link hover__black" href="{{ route('contact-us') }}">CONTACT US</a>
                @endguest
            </div>
            <div class="d-flex justify-content-end">
                <p class="footer__copyright">
                    &copy; Copyright 2020 by Konti-tracking systems.
                </p>
            </div>
        </div>
    </footer>
</div>

