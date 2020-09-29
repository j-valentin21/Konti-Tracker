@extends('layouts.master')

@section('title', "Build-Your-Profile")

@section('body-content')


                    <div class="row p-5">
                        <div class="col-4">
                            <!-- ========== STEPS ========== -->
                            <ol class="form__wizard__steps ">
                                <li class="mb-4 form__wizard__steps--active-top">Build Your Profile</li>
                                <li class="mb-4">Avatar</li>
                                <li class="mb-4">Confirmation</li>
                            </ol>
                        </div>
                        <form method="POST" action="{{ route('profile.post') }}">
                            @csrf
                            <div class="col-8">
                                <!-- ========== POSITION ========== -->
                                <div class="form-group mb-4">
                                    <input id="position"
                                           type="text"
                                           class="form-input registration__input @error('position') is-invalid @enderror"
                                           name="position"
                                           placeholder="What is your position?"
                                           value="{{ $profile->position ?? ""}}"
                                           required autocomplete="position"/>
                                    <label for="position" class="registration__label">{{ __('What is your position?') }}</label>

                                    @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                    <label for="position" class="registration__label">{{ __('How many PTO days do you have available?') }}</label>

                                    @error('pto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                    <label for="position" class="registration__label">{{ __('How many points do you have?') }}</label>

                                    @error('points')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- ========== BUTTON ========== -->
                                <div class="text-right">
                                    <button type="submit" class="form__wizard__btn">
                                        {{ __('Next') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>





@stop
@section('body-scripts')
    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
        crossorigin="anonymous">
    </script>
    <script src="{{ asset('jquery/modal.js') }}"></script>
@endsection






