@extends('layouts.master')

@section('title', "Profile")

@section('class', 'dashboard')

@section('content', "UPDATE PASSWORD")

@section('id', 'app')

@section('body-header')
    @include("layouts.navbar.dashboard")
@endsection

@section('body-content')
    <div class="container-fluid">
        <x-dash-sidebar/>
        <div class="dashboard__main my-3">
            <div class="dashboard__main-content  dashboard__main-content--grey d-flex justify-content-center my-5">
                <form method="POST" action="{{ route('dashboard.password.update') }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    @if(session('errorMsg'))
                        <div class="col-sm-12">
                            <div class="alert fade alert__danger alert-dismissible text-left brk-library-rendered rendered show">
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true" class="mb-5">
                                        <svg class="alert__icon alert__icon--x_red">
                                            <use href="{{asset('svg/sprite.svg#icon-times')}}"></use>
                                        </svg>
                                    </span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <span class="alert__start">
                                    <svg class="alert__icon alert__icon--danger">
                                        <use href="{{asset('svg/sprite.svg#icon-dangerous')}}"></use>
                                    </svg>
                                </span>
                                <strong class="font__weight-semibold">{{session('errorMsg')}}</strong>
                            </div>
                        </div>
                    @endif
                    <div class="mx-5 mx-sm-5">
                        <div class="mr-4">
                            <!-- ==========OLD PASSWORD ========== -->
                            <div class="form-group mb-4 mt-5">
                                <input id="oldpassword"
                                       type="password"
                                       class="form-input registration__input @error('old password') is-invalid @enderror"
                                       name="oldpassword"
                                       placeholder="Old Password"
                                       required autocomplete="old password"/>
                                @error('old password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if (!$errors->has('old password'))
                                    <label for="password" class="registration__label">{{ __('Old Password') }}</label>
                                @endif
                            </div>
                            <!-- ========== PASSWORD ========== -->
                            <div class="form-group mb-4">
                                <input id="password"
                                       type="password"
                                       class="form-input registration__input @error('password') is-invalid @enderror"
                                       name="password"
                                       placeholder="Password"
                                       required autocomplete="password"/>
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
                            <div class="form-group mb-5">
                                <input id="password-confirm"
                                       type="password"
                                       class=" mb-3 form-input registration__input @error('password_confirmation') is-invalid @enderror"
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
                            </div>
                        </div>
                        <!-- ========== SIGN UP BUTTON ========== -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="form-submit registration__signup w-50 mb-5">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <request-pto-form :pto="{{ auth()->user()->profile->pto }}"/>
    </div>
@endsection

