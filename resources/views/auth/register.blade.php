@extends('layouts.master')

@section('title', "Registration")

@section('class', 'registration d-flex justify-content-end')

@section('body-content')

<div class="d-flex justify-content-end">
    <section class="registration__container d-flex justify-content-center">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h2 class="registration__title">{{ __('Register') }}</h2>
            {{-- NAME --}}

            <div class="form-group mb-4">
                <input id="name"
                       type="text"
                       class="form-input registration__input  @error('name') is-invalid @enderror"
                       name="name"
                       placeholder="Name"
                       value="{{ old('name') }}"
                       required autocomplete="name" autofocus />
                <label for="name" class="registration__label">{{ __('Name') }}</label>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            {{-- EMAIL --}}
            <div class="form-group mb-4">
                <input id="email"
                       type="email"
                       class="form-input registration__input @error('email') is-invalid @enderror"
                       name="email"
                       placeholder="Email"
                       value="{{ old('email') }}"
                       required autocomplete="email"/>
                <label for="email" class="registration__label">{{ __('Email') }}</label>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            {{-- PASSWORD --}}
            <div class="form-group mb-4">
                <input id="password"
                       type="password"
                       class="form-input registration__input @error('password') is-invalid @enderror"
                       name="password"
                       placeholder="Password"
                       required autocomplete="new-password"/>
                <label for="password" class="registration__label">{{ __('Password') }}</label>

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            {{--CONFIRM PASSWORD--}}
            <div class="form-group mb-4">
                <input id="password-confirm"
                       type="password"
                       class="form-input registration__input @error('password_confirmation') is-invalid @enderror"
                       name="password_confirmation"
                       placeholder="Confirm Password"
                       required autocomplete="new-password"/>
                <label for="password-confirm" class="registration__label">{{ __('Confirm Password') }}</label>

                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            {{--SIGN UP BUTTON--}}
                <button type="submit" class="form-submit registration__signup" >
                    {{ __('Sign up') }}
                </button>
            {{--LOGIN LINK--}}
            <p class="registration__login">
                Have already an account? <a data-toggle="modal" href="#exampleModalCentered" class="loginhere-link">Login here</a>
            </p>

            <x-login_modal></x-login_modal>

        </form>
    </section>
</div>
@stop
