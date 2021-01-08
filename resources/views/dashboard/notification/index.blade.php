@extends('layouts.master')

@section('title', "Notifications")

@section('class', 'dashboard')

@section('content', "NOTIFICATIONS")

@section('id', 'app')

@section('body-header')
    @include("layouts.navbar.dashboard")
@endsection

@section('body-content')
    <div class="container-fluid">
        <x-dash-sidebar/>
        <div class="dashboard__main">
            <div class="dashboard__main-content  dashboard__main-content--pto">
                <notification :user_id="{{ $userId }}"/>
            </div>
        </div>
        <request-pto-form :pto="{{ auth()->user()->profile->pto }}"/>
    </div>
@endsection
