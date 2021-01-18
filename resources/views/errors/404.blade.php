@extends('layouts.master')

@section('id', 'app')

@section('body-content')
    <div class="error-page__background error-page__stars">
    <div class="error-page__twinkling"></div>
        <div class="error-page__ground"></div>
    </div>
    <main class="error-page">
        <section class="error-page__left-section">
            <div class="error-page__inner-content">
                <h1 class="error-page__header">404</h1>
                <p class="error-page__subheading">Looks like the page you were looking for is no longer here.</p>
            </div>
        </section>
        <section class="error-page__right-section">
            <svg class="error-page__svgimg" xmlns="http://www.w3.org/2000/svg" viewBox="51.5 -15.288 385 505.565">
                <!-- ========== BENCH SVG ========== -->
                <g class="error-page__svgimg--bench-legs">
                    <use href="{{ asset('svg/sprite.svg#bench-legs') }}"></use>
                </g>
                <g class="error-page__svgimg--top-bench">
                    <use href="{{ asset('svg/sprite.svg#top-bench') }}"></use>
                </g>
                <g class="error-page__svgimg--bottom-bench">
                    <use href="{{ asset('svg/sprite.svg#bottom-bench') }}"></use>
                </g>
                <!-- ========== LAMP SVG ========== -->
                <g>
                    <use class="error-page__svgimg--lamp-details" href="{{ asset('svg/sprite.svg#lamp-details') }}"></use>
                    <use class="error-page__svgimg--lamp-accent" href="{{ asset('svg/sprite.svg#lamp-accent') }}"></use>
                    <use class="error-page__svgimg--lamp-light" href="{{ asset('svg/sprite.svg#lamp-light') }}"></use>
                    <use class="error-page__svgimg--lamp-bottom" href="{{ asset('svg/sprite.svg#lamp-bottom') }}"></use>
                    <use class="error-page__svgimg--lamp-details" href="{{ asset('svg/sprite.svg#lampster') }}"></use>
                </g>
                <radialGradient  class="light-gradient" id="SVGID_1_" cx="119.676" cy="44.22" r="65" gradientUnits="userSpaceOnUse">
                    <stop  offset="0%" style="stop-color:#FFFFFF; stop-opacity: 1"/>
                    <stop  offset="50%" style="stop-color:#EDEDED; stop-opacity: 0.5">
                        <animate attributeName="stop-opacity" values="0.0; 0.5; 0.0" dur="5000ms" repeatCount="indefinite"></animate>
                    </stop>
                    <stop  offset="100%" style="stop-color:#EDEDED; stop-opacity: 0"/>
                </radialGradient>
                <circle id="lamp-light-glow" class="error-page__svgimg--lamp-light__glow" fill="url(#SVGID_1_)" cx="119.676" cy="44.22" r="65"/>
            </svg>
        </section>
    </main>
@endsection
