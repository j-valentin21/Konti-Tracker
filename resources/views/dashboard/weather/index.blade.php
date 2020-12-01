@extends('layouts.master')

@section('head-extra')
    <script src="{{asset('js/scripts/skycons.js')}}"></script>
@endsection

@section('title', "Profile")

@section('class', 'dashboard')

@section('content', "WEATHER")

@section('id', 'app')

@section('body-header')
    @include("layouts.navbar.dashboard")
@endsection

@section('body-content')
    <div class="container-fluid">
        <x-dash-sidebar/>
            <div class=" dashboard__main-content--weather">
                <weather/>
            </div>
        </div>
    </div>
@endsection

