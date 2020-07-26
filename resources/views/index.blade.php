@extends('layouts.master')

@section('title', "Konti-Tracker")

@section('class', 'homepage__bg')

@section('body-header')
    @include("layouts.navbar.index")
@stop

@section('body-content')

    <x-login_modal></x-login_modal>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-11 mx-auto mb-5">

                <x-carousel_index></x-carousel_index>

                <x-pto_jumbotron></x-pto_jumbotron>

                <x-konti-cards></x-konti-cards>

            @section('body-footer')
                @include("layouts.footer.index")
            @endsection

            </div>
        </div>
    </div>
@stop
<!-- SCRIPTS -->
@section('body-scripts')
    <script src="{{ asset('js/scripts/intersection_observer/index.js') }}"></script>
@stop



