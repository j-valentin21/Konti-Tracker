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
                    <img class="img-fluid pto__img " src="{{ asset('img/new.jpg') }}" alt="'New' icon">
                    <div class="text-center">
                        <h3 class="pto__heading">PTO Purchase Program</h3>
                        <p class="lead">You can purchase up to 10 days of additional PTO</p>
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



