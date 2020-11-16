@extends('layouts.master')

@section('title', "Profile")

@section('class', 'dashboard')

@section('content', "CALENDAR")

@section('id', 'app')

@section('body-header')
    @include("layouts.navbar.dashboard")
@endsection

@section('body-content')
    <div class="container-fluid">
        <x-dash-sidebar/>
        <div class="dashboard__main my-3">
            <div class="dashboard__main-content  dashboard__main-content--grey m-5 d-flex justify-content-center my-5">
                <calendar :calendar="{{ json_encode($calendar ?? 0 )}}"></calendar>
            </div>
        </div>
    </div>
@endsection
