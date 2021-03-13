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
            <div class="dashboard__main-content  dashboard__main-content--grey">
                <form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data">
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
                                <strong class="alert__message">{{ session('errorMsg') }}</strong>
                            </div>
                        </div>
                    @endif
                    <div class="container dashboard__form">
                        <h5 class="form__wizard__title">Profile</h5>
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
                        <div class="form-group mb-4">
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
                                   min="0"
                                   max="40" required/>
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
                                   min="0"
                                   max="15" required/>
                            @error('points')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if (!$errors->has('points'))
                                <label for="position" class="registration__label">{{ __('Points') }}</label>
                            @endif
                        </div>
                        <!-- ========== DATE OF EMPLOYMENT ========== -->
                        <div class="form-group mb-5">
                            <input id="date_of_employment"
                                   type="date"
                                   class="form-input registration__input @error('date_of_employment') is-invalid @enderror"
                                   name="date_of_employment"
                                   placeholder="Date of employment"
                                   value="{{  auth()->user()->profile->date_of_employment }}"
                                   required>
                            @error('date_of_employment')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if (!$errors->has('date_of_employment'))
                                <label for="position" class="registration__label">{{ __('Date of employment') }}</label>
                            @endif
                        </div>
                        <!-- ========== AVATAR ========== -->
                        @if(!isset(auth()->user()->profile->avatar))
                            <label class="form__wizard__title" for="image" class="text-break">{{ __('Upload Avatar') }}</label>
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
                                Please upload a valid image file. Size of image should not be more than 10MB.
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
                    <figure class="my-3 mr-5">
                        <h5 class="form__wizard__title">Avatar</h5>
                        <img class=" my-3 mx-3  form__wizard__img" alt="Avatar" src="{{ Storage::disk('s3')->url(auth()->user()->profile->avatar) }}">
                    </figure>
                    <form method="POST" action="{{ route('dashboard.profile.destroy') }}">
                        @method('DELETE')
                        @csrf
                        <div class="text-center">
                            <button type="submit" class="form__wizard__btn form__wizard__btn--red mb-5 width__35">Remove Avatar</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <request-pto-form :pto="{{ auth()->user()->profile->pto }}"/>
@endsection
