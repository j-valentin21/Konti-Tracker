@extends('layouts.master')

@section('title', "Build-Your-Profile")

@section('body-content')
    <form action="">
        <div class="container-fluid">
            <div class="modal fade bd-example-modal-lg profile" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="row">
                            <div class="col-12">
                                <section class="form__wizard">
                                    <img class="form__wizard__img img-fluid" src="{{ asset('img/limo_car.jpg') }}" alt="">
                                    <h3 class="form__wizard__header">Welcome to Konti-Tracker</h3>
                                </section>
                            </div>
                        </div>
                        <div class="row p-5">
                            <div class="col-4">
                                <ol class="form__wizard__steps ">
                                    <li class="mb-4 form__wizard__steps--active">Build Your Profile</li>
                                    <li class="mb-4">PTO/Points</li>
                                    <li class="mb-4">Confirmation</li>
                                </ol>
                            </div>
                            <div class="col-8">
                                <div class="form-group mb-4">
                                    <input id="position"
                                           type="text"
                                           class="form-input registration__input @error('position') is-invalid @enderror"
                                           name="position"
                                           placeholder="What is your position?"
                                           value="{{ old('position') }}"
                                           required autocomplete="position"/>
                                    <label for="position" class="registration__label">{{ __('What is your position?') }}</label>

                                    @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div>
                                    <div class="form-group">
                                        <label class="form__wizard__label" for="img" class="text-break">{{ __('Upload Image') }}</label>
                                        <input type="file"  class="form-control-file" name="img" id="img" aria-describedby="fileHelp">
                                        <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                                    </div>
                                </div>
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






