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
            <div class="dashboard__main-content  dashboard__main-content--grey m-5 d-flex justify-content-center my-5">
                <form method="POST" action="{{ route('dashboard.password.update') }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mx-5 mx-sm-5">
                        <div class="mr-4">
                            <!-- ==========OLD PASSWORD ========== -->
                            <div class="form-group mb-4 mt-5">
                                <input id="password"
                                       type="password"
                                       class="form-input registration__input @error('password') is-invalid @enderror"
                                       name="password"
                                       placeholder="Old Password"
                                       required autocomplete="old password"/>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @if (!$errors->has('password'))
                                    <label for="password" class="registration__label">{{ __('Old Password') }}</label>
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
    </div>
@endsection

