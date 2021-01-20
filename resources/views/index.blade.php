@extends('layouts.master')

@section('title', "Konti-Tracker")

@section('class', 'homepage__bg')

@section('body-header')
    @include("layouts.navbar.index")
@endsection

@section('body-content')
    <x-login-modal/>
    <main class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-11 mx-auto mb-5">
                <x-carousel/>
                <section class="jumbotron mt-4 mt-sm-0 pto">
                    <img class="img-fluid pto__img" src="{{ asset('img/new.jpg') }}" alt="'New' icon">
                    <div class="text-center">
                        <h3 class="pto__heading">PTO Purchase Program</h3>
                        <p class="lead">You can purchase up to 10 days of additional PTO</p>
                    </div>
                </section>
                <section class="features">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <header>
                                    <h2 class="features__header">Our features</h2>
                                </header>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row features__bg-row features__bg-img">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <section class="features__counter">
                                            <div class="features__list">
                                                <article class="features__item mt-5">
                                                    <h3 class="features__item-header">Calendar</h3>
                                                    <p>You have access to a fully functional calendar. This allows you to keep track of all the important events in your life.</p>
                                                </article>
                                            </div>
                                            <div class="features__list">
                                                <article class="features__item">
                                                    <h3 class="features__item-header">Weather Forecast</h3>
                                                    <p>Check the weather anytime before you schedule your day off</p>
                                                </article>
                                            </div>
                                            <div class="features__list">
                                                <article class="features__item">
                                                    <h3 class="features__item-header">PTO Request Form</h3>
                                                    <p>Schedule your PTO days with your supervisor/manager directly from the dashboard within minutes </p>
                                                </article>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <x-konti-cards/>
                @section('body-footer')
                    @include("layouts.footer.index")
                @endsection
            </div>
        </div>
    </main>
@endsection
<!-- SCRIPTS -->
@section('body-scripts')
    <script src="{{ asset('js/scripts/intersection_observer/index.js') }}"></script>
@endsection



