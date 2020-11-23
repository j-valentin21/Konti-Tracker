@extends('layouts.master')

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
                <div class="weather">
                    <div class="weather__container">
                        <header class="weather__header">
                            <input type="text" autocomplete="off" class="weather__header-text" placeholder="Search for a city..." />
                        </header>
                        <main class="weather__body">
                            <section>
                                <div class="weather__city">Orefield, PA</div>
                                <div class="weather__date">Thursday 10 January 2020</div>
                            </section>
                            <div>
                                <div class="weather__temp">15<span class="weather__celsius">°c</span></div>
                                <div class="weather__name">Sunny</div>
                                <div class="weather__hi-lo">13°c / 16°c</div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
