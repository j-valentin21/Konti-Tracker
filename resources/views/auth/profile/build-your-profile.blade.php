@extends('layouts.master')
@section('title', "Build-Your-Profile")

@section('body-content')
    <main class="container-fluid">
        <div class="modal fade bd-example-modal-lg profile" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered form__wizard__modal">
                <div class="modal-content">
                    <section class="row">
                        <div class="col-12">
                            <figure class="form__wizard">
                                <img class="form__wizard__header-img" src="{{ asset('img/luxury_car.jpg') }}" alt="luxury car">
                                <figcaption class="form__wizard__header">Welcome to Konti-Tracker</figcaption>
                            </figure>
                        </div>
                    </section>
                    <div class="row p-5">
                        <section class="col-sm-4">
                            <!-- ========== STEPS ========== -->
                            <ol class="form__wizard__steps ">
                                <li class="mb-4 form__wizard__steps--active-top">Build Your Profile</li>
                                <li class="mb-4">Avatar</li>
                                <li class="mb-4">Confirmation</li>
                            </ol>
                        </section>
                        <section class="col-sm-8">
                            <form method="POST" action="{{ route('profile.create') }}">
                                @csrf
                                <!-- ========== POSITION ========== -->
                                <div class="form-group mb-4">
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
                                <!-- ========== DATE OF EMPLOYMENT ========== -->
                                <div class="form-group mb-4">
                                    <input id="date_of_employment"
                                           type="date"
                                           class="form-input registration__input @error('date_of_employment') is-invalid @enderror"
                                           name="date_of_employment"
                                           placeholder="Date of employment"
                                           value="{{ $profile->date_of_employment ?? "" }}"
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
                                <!-- ========== BUTTON ========== -->
                                <div class="text-center text-sm-right">
                                    <button type="submit" class="form__wizard__btn form__wizard__btn--orange">
                                        {{ __('Next') }}
                                    </button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
@section('body-scripts')
    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
        crossorigin="anonymous">
    </script>
    <script src="{{ asset('jquery/modal.js') }}"></script>
@endsection






