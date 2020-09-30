@extends('layouts.master')

@section('title', "Konti-Tracker")

@section('class', 'homepage__bg')

@section('body-header')
    @include("layouts.navbar.index")
@endsection

@section('body-content')

    <x-login-modal/>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-11 mx-auto mb-5">

                <x-carousel/>

                <x-pto-jumbotron/>

                <x-konti-cards/>

                @section('body-footer')
                    @include("layouts.footer.index")
                @endsection
            </div>
        </div>
    </div>
@endsection
<!-- SCRIPTS -->
@section('body-scripts')
    <script src="{{ asset('js/scripts/intersection_observer/index.js') }}"></script>
@endsection



