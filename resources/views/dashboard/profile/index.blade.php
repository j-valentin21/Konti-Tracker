@extends('layouts.master')

@section('title', "Profile")

@section('class', 'dashboard')

@section('content', "PROFILE")

@section('id', 'app')

@section('body-header')
    @include("layouts.navbar.dashboard")
@endsection

@section('body-content')
    <div class="container-fluid">
        <x-dash-sidebar/>

        <div class="dashboard__main">
            <div class="dashboard__main-content  dashboard__main-content--grey m-5">
                <form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                    <div class="mx-5 mx-sm-5 container">
                        <!-- ========== NAME ========== -->
                        <div class="form-group my-4">
                            <input id="name"
                                   type="text"
                                   class="form-input registration__input registration__input--profile  @error('name') is-invalid @enderror"
                                   name="name"
                                   placeholder= "Name"
                                   value="{{ auth()->user()->name ?? ""}}"
                                   autocomplete="name"/>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if (!$errors->has('name'))
                                <label for="position" class="registration__label">{{ __('Name') }}</label>
                            @endif
                        </div>
                        <!-- ========== EMAIL ========== -->
                        <div class="form-group my-4">
                            <input id="email"
                                   type="email"
                                   class="form-input registration__input registration__input--profile  @error('email') is-invalid @enderror"
                                   name="email"
                                   placeholder= "email"
                                   value="{{ auth()->user()->email ?? ""}}"
                                   autocomplete="name"/>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if (!$errors->has('email'))
                                <label for="position" class="registration__label">{{ __('Email') }}</label>
                            @endif
                        </div>
                    <!-- ========== POSITION ========== -->
                        <div class="form-group mb-4 mr-5" >
                            <input id="position"
                                   type="text"
                                   class="form-input registration__input registration__input--profile @error('position') is-invalid @enderror"
                                   name="position"
                                   placeholder= "Position"
                                   value="{{ auth()->user()->profile->position ?? ""}}"
                                   required autocomplete="position"/>
                            @error('position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if (!$errors->has('position'))
                                <label for="position" class="registration__label">{{ __('Position') }}</label>
                            @endif
                        </div>
                        <!-- ========== PTO ========== -->
                        <div class="form-group mb-4">
                            <input id="pto"
                                   type="text"
                                   class="form-input registration__input registration__input--profile @error('pto') is-invalid @enderror"
                                   name="pto"
                                   placeholder="PTO"
                                   value="{{ auth()->user()->profile->pto  ?? ""}}"
                                   required/>
                            @error('pto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if (!$errors->has('pto'))
                                <label for="position" class="registration__label">{{ __('PTO') }}</label>
                            @endif
                        </div>
                        <!-- ========== POINTS ========== -->
                        <div class="form-group mb-5">
                            <input id="points"
                                   type="text"
                                   class="form-input registration__input registration__input--profile @error('points') is-invalid @enderror"
                                   name="points"
                                   placeholder="Points"
                                   value="{{ auth()->user()->profile->points ?? ""}}"
                                   required/>
                            @error('points')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if (!$errors->has('points'))
                                <label for="position" class="registration__label">{{ __('Points') }}</label>
                            @endif
                        </div>
                        <!-- ========== AVATAR ========== -->
                        @if(!isset(auth()->user()->profile->avatar))
                            <label class="form__wizard__label" for="image" class="text-break">{{ __('Upload Avatar') }}</label>
                            <input
                                type="file" {{ (!empty(auth()->user()->profile->avatar)) ? "disabled" : ''}}
                                accept="image/x-png,image/gif,image/jpeg, image/svg image/jpg"
                                class="form-control-file @error('avatar') is-invalid @enderror"
                                name="avatar"
                                id="avatar"
                                aria-describedby="fileHelp">

                            @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small
                                id="fileHelp"
                                class="form-text text-muted form form__wizard__img-text">
                                Please upload a valid image file. Size of image should not be more than 2MB.
                            </small>
                        @endif
                        <!-- ========== BUTTON ========== -->
                    </div>
                    <div class="text-center">
                        <button type="submit" class="form__wizard__btn form__wizard__btn--orange mb-5 width__25">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
                <!-- ========== REMOVE AVATAR  ========== -->
                @if(isset(auth()->user()->profile->avatar))
                    <div class="my-3 mr-5">
                        <h6 class="form__wizard__label">Avatar</h6>
                        <img class=" my-3  form__wizard__img w-55" alt="Avatar" src="{{ Storage::disk('s3')->url(auth()->user()->profile->avatar) }}">
                    </div>
                    <form method="POST" action="{{ route('dashboard.profile.destroy') }}">
                        @method('DELETE')
                        @csrf
                        <div class="text-center">
                            <button type="submit" class="form__wizard__btn form__wizard__btn--red mb-5 width__25">Remove Avatar</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
