@extends('layouts.master')

@section('title', "Registration")

@section('class', 'registration d-flex justify-content-end')

@section('body-content');

{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}


{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}

<section class="registration__container justify-content-center">
    <form method="POST" id="signup-form" class="signup-form" action="{{ route('register') }}  class="signup-form">
        @csrf
        <h2 class="registration__title">{{ __('Register') }}</h2>
        {{-- NAME --}}
        </form>
        <div class="form-group mb-4">
            <label for="name" class="registration__label">{{ __('Name') }}</label>
            <input id="name"
                   type="text"
                   class="form-input registration__input  @error('name') is-invalid @enderror"
                   name="name"
                   value="{{ old('name') }}"
                   required autocomplete="name" autofocus />

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        {{-- EMAIL --}}
        <div class="form-group mb-4">
            <label for="email" class="registration__label">{{ __('Email') }}</label>
            <input id="email"
                   type="email"
                   class="form-input registration__input @error('email') is-invalid @enderror"
                   name="email"
                   value="{{ old('email') }}"
                   required autocomplete="email"/>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        {{-- PASSWORD --}}
        <div class="form-group mb-4">
            <label for="password" class="registration__label">{{ __('password') }}</label>
            <input id="password"
                   type="password"
                   class="form-input registration__input @error('password') is-invalid @enderror"
                   name="password"
                   required autocomplete="new-password"/>

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        {{--confirm password--}}
        <div class="form-group mb-4">\
            <label for="password-confirm" class="registration__label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm"
                   type="password"
                   class="form-input registration__input"
                   name="password_confirmation"
                   required autocomplete="new-password"/>
        </div>
        {{--sign up button--}}
        <div class="form-group mb-4">
            <input type="submit" name="submit" id="submit" class="form-submit registration__signup" value="Sign up"/>
        </div>

        <p class="registration__login">
            Have already an account? <a href="#" class="loginhere-link">Login here</a>
        </p>
    </form>
</section>
@stop
