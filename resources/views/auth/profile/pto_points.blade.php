@extends('layouts.master')

@section('title', "PTO/Points")

@section('body-content')
    <form method="POST" action="{{ route('pto_points') }}">
        @csrf

        <div class="container-fluid">
            <div class="modal fade bd-example-modal-lg profile" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="row">
                            <!-- ========== HEADER========== -->
                            <div class="col-12">
                                <section class="form__wizard">
                                    <img class="form__wizard__img img-fluid" src="{{ asset('img/limo_car.jpg') }}" alt="">
                                    <h3 class="form__wizard__header">Welcome to Konti-Tracker</h3>
                                </section>
                            </div>
                        </div>
                        <div class="row p-5">
                            <!-- ========== STEPS ========== -->
                            <div class="col-4">
                                <ol class="form__wizard__steps ">
                                    <li class="mb-4 form__wizard__steps--active">Build Your Profile</li>
                                    <li class="mb-4">PTO/Points</li>
                                    <li class="mb-4">Confirmation</li>
                                </ol>
                            </div>
                            <div class="col-8">
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
                                <!-- ========== BUTTON ========== -->
                                <div class="text-right">
                                    <button type="submit" class="form__wizard__btn">
                                        {{ __('Next') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
@section('body-scripts')
    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
        crossorigin="anonymous">
    </script>
    <script src="{{ asset('jquery/modal.js') }}"></script>
@endsection
