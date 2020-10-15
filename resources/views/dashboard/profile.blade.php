@extends('layouts.master')

@section('title', "Dashboard")

@section('class', 'dashboard')

@section('id', 'app')

@section('body-header')
    @include("layouts.navbar.dashboard")
@endsection

@section('body-content')
    <div class="container-fluid">
        <x-dash-sidebar/>
    </div>

@endsection
