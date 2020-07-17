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

                <x-pto_jumbotron></x-pto_jumbotron>

                <x-konti-cards></x-konti-cards>


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


