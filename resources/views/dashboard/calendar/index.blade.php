@extends('layouts.master')
@section('title', "Calendar")
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
            <div class="dashboard__main-content  dashboard__main-content--grey m-lg-5 my-5">
                <calendar/>
            </div>
        </div>
        <request-pto-form :pto="{{ auth()->user()->profile->pto }}"/>
    </div>
@endsection
