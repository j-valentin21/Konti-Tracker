@extends('layouts.master')

@section('title', "Dashboard Activity")

@section('class', 'dashboard')

@section('content', "DASHBOARD ACTIVITY")

@section('id', 'app')

@section('body-header')
    @include("layouts.navbar.dashboard")
@endsection

@section('body-content')
    <div class="container-fluid">
        <x-dash-sidebar/>
        <div class="dashboard__main">
            <div class="dashboard__main-content  dashboard__main-content--pto">
                <activity :activity="{{ $activity }}"/>
            </div>
        </div>
    </div>
@endsection
