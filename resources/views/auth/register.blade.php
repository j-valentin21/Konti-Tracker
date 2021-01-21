@extends('layouts.master')
@section('title', "Registration")
@section('class', 'registration')
@section('body-content')

<div class="d-flex justify-content-end">
    <section class="registration__container d-flex justify-content-center">
        <form class="my-auto" method="POST" action="{{ route('register') }}">
            @csrf
            <h2 class="registration__title">{{ __('Register') }}</h2>
            <!-- ========== NAME ========== -->
            <div class="form-group mb-4">
                <input id="name"
                       type="text"
                       class="form-input registration__input  @error('name') is-invalid @enderror"
                       name="name"
                       placeholder="Name"
                       value="{{ old('name') }}"
                       required autocomplete="name" autofocus />
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @if (!$errors->has('name'))
                    <label for="name" class="registration__label">{{ __('Name') }}</label>
                @endif
            </div>
            <!-- ========== EMAIL ========== -->
            <div class="form-group mb-4">
                <input id="email"
                       type="email"
                       class="form-input registration__input @error('email') is-invalid @enderror"
                       name="email"
                       placeholder="Email"
                       value="{{ old('email') }}"
                       required autocomplete="email"/>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @if (!$errors->has('email'))
                    <label for="email" class="registration__label">{{ __('Email') }}</label>
                @endif
            </div>
            <!-- ========== PASSWORD ========== -->
            <div class="form-group mb-4">
                <input id="password"
                       type="password"
                       class="form-input registration__input @error('password') is-invalid @enderror"
                       name="password"
                       placeholder="Password"
                       required autocomplete="new-password"/>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @if (!$errors->has('password'))
                    <label for="password" class="registration__label">{{ __('Password') }}</label>
                @endif
            </div>
            <!-- ========== CONFIRM PASSWORD ========== -->
            <div class="form-group mb-4">
                <input id="password-confirm"
                       type="password"
                       class="form-input registration__input @error('password_confirmation') is-invalid @enderror"
                       name="password_confirmation"
                       placeholder="Confirm Password"
                       required autocomplete="new-password"/>
                @error('password_confirmation')
                <span class="invalid-feedback mb-3" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @if (!$errors->has('password_confirmation'))
                    <label for="password_confirmation" class="registration__label mb-3">{{ __('Confirm Password') }}</label>
                @endif
                <!-- ========== SIGN UP BUTTON ========== -->
                <button type="submit" class="form-submit registration__signup" >
                    {{ __('Sign up') }}
                </button>
                {{--LOGIN LINK--}}
                <p class="registration__login">
                    Have already an account? <a data-toggle="modal" data-target="#loginmodal" class="text-primary" role="button">Login here</a>
                </p>
            </div>
            <x-login_modal></x-login_modal>
        </form>
    </section>
</div>
@stop
