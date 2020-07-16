@extends('layouts.master')

@section('title', "Konti-Tracker")

@section('class', 'homepage__bg')

@section('body-header')
    @include("layouts.navbar.index")
@stop

@section('body-content')

    <x-loginmodal></x-loginmodal>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-11 mx-auto mb-5">

                <x-carousel_index></x-carousel_index>

                <!-- PTO JUMBOTRON -->
                <section class="jumbotron mt-4 mt-sm-0 pto">
                    <img class="img-fluid pto__img " src="img/new.jpg" alt="'New' icon">
                    <div class="text-center">
                        <h3 class="pto__heading">PTO Purchase Program</h3>
                        <p class="lead">You can purchase up to 10 days of additional PTO</p>
                    </div>
                </section>
                <section class="container-fluid">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-5">
                                <!-- KONTI-CARDS -->
                            <div class="konti-cards card card-animation__left">
                                <img class="card-img-top konti-card__img my-3 w-25 mx-auto"  src="svg/car-parts.svg" alt="tracker">
                                <div class="card-body">
                                    <h4 class="card-title">PTO Tracking software</h4>
                                    <p class="card-text">
                                        Your attendance, years of service, scheduled/unschduled time all tracked in one location.
                                    </p>
                                </div>
                            </div>
                            <div class="konti-cards card card-animation__left">
                                <img class="card-img-top konti-card__img mx-auto my-3 w-25" src="svg/brake-disc.svg" alt="brake disc">
                                <div class="card-body">
                                    <h4 class="card-title">No more PTO/attendance sheet request</h4>
                                    <p class="card-text">
                                        Put a <span class="font-weight-bolder">stop</span> on tracking everything on paper. Let the Konti-Tracker do all the work.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 my-5 my-sm-1 ">
                            <div class="konti-cards card card-animation__right">
                                <img class="card-img-top konti-card__img my-4  w-25 mx-auto"  src="svg/graph.svg" alt="graph">
                                <div class="card-body">
                                    <h4 class="card-title display-5">Graphs</h4>
                                    <p class="card-text">
                                        Beautifully designed graphs to view all your customized data.
                                    </p>
                                </div>
                            </div>
                            <div class="konti-cards card card-animation__right">
                                <img class="card-img-top konti-card__img my-3 w-25 mx-auto"  src="svg/car-parts.svg" alt="tracker">
                                <div class="card-body">
                                    <h4 class="card-title">PTO Tracking software</h4>
                                    <p class="card-text text-dark">
                                        Your attendance, years of service, scheduled/unschduled time all tracked in one location.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- FOOTER -->
                <footer class="footer d-flex flex-wrap align-content-end">
                    <div class="container">
                        <h2 class="footer__primary text-center mt-4">SITE LINKS</h2>
                        <div class="d-flex justify-content-around">
                            <a class="footer__link hover__black" href="#">HOME</a>
                            <a class="footer__link hover__black" href="#">SIGNUP/REGISTER</a>
                            <a class="footer__link hover__black" href="#">SIGN IN</a>
                            <a class="footer__link hover__black" href="#">CONTACT US</a>
                        </div>
                        <div class="d-flex justify-content-end">
                            <p class="footer__copyright">
                                &copy; Copyright 2020 by Konti-tracking systems.
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <!-- SCRIPTS -->
     <script src="{{ asset('js/scripts/intersection_observer/index.js') }}"></script>
@stop


