@extends('layouts.master')

@section('title', "Profile")

@section('class', 'dashboard')

@section('content', "Profile")

@section('id', 'app')

@section('body-header')
    @include("layouts.navbar.dashboard")
@endsection

@section('body-content')
    <div class="container-fluid">
        <x-dash-sidebar/>
        <div class="dashboard__main">
            <div class="dashboard__main-content  dashboard__main-content--grey m-5">
                <div class="d-flex justify-content-center">
                    <div class="">
                        <form method="POST" action="{{ route('profile.post') }}">
                        @csrf
                        <!-- ========== POSITION ========== -->
                            <div class="form-group mb-4 mr-5">
                                <input id="position"
                                       type="text"
                                       class="form-input registration__input @error('position') is-invalid @enderror"
                                       name="position"
                                       placeholder="What is your position?"
                                       value="{{ $profile->position ?? ""}}"
                                       required autocomplete="position"/>
                                @error('position')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                                @if (!$errors->has('position'))
                                    <label for="position" class="registration__label">{{ __('What is your position?') }}</label>
                                @endif
                            </div>
                            <!-- ========== PTO ========== -->
                            <div class="form-group mb-4">
                                <input id="pto"
                                       type="text"
                                       class="form-input registration__input @error('pto') is-invalid @enderror"
                                       name="pto"
                                       placeholder="PTO"
                                       value="{{ $profile->pto ?? ""}}"
                                       required/>
                                @error('pto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @if (!$errors->has('pto'))
                                    <label for="position" class="registration__label">{{ __('How many PTO days do you have available?') }}</label>
                                @endif
                            </div>
                            <!-- ========== POINTS ========== -->
                            <div class="form-group mb-4">
                                <input id="points"
                                       type="text"
                                       class="form-input registration__input @error('points') is-invalid @enderror"
                                       name="points"
                                       placeholder="Points"
                                       value="{{ $profile->points ?? ""}}"
                                       required/>
                                @error('points')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @if (!$errors->has('points'))
                                    <label for="position" class="registration__label">{{ __('How many points do you have?') }}</label>
                                @endif
                            </div>
                            <!-- ========== BUTTON ========== -->
                            <div class="text-center text-sm-right">
                                <button type="submit" class="form__wizard__btn form__wizard__btn--orange">
                                    {{ __('Next') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
