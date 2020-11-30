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
        <div class="dashboard__main">
            <div class="dashboard__main-content  dashboard__main-content--grey m-3">
                <weather/>
            </div>
        </div>
    </div>
@endsection

