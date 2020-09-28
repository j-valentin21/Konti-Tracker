@extends('layouts.master')

@section('title', "Avatar")

@section('body-content')
    <div class="container-fluid">
        <div class="modal fade bd-example-modal-lg profile" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="row">
                        <!-- ========== HEADER========== -->
                        <div class="col-12">
                            <section class="form__wizard">
                                <img class="form__wizard__img img-fluid" src="{{ asset('img/limo_car.jpg') }}" alt="limo">
                                <h3 class="form__wizard__header">Welcome to Konti-Tracker</h3>
                            </section>
                        </div>
                    </div>
                    <div class="row p-5">
                        <!-- ========== STEPS ========== -->
                        <div class="col-4">
                            <ol class="form__wizard__steps">
                                <li class="mb-4">Build Your Profile</li>
                                <li class="mb-4 form__wizard__steps--active-middle">Avatar</li>
                                <li class="mb-4">Confirmation</li>
                            </ol>
                        </div>
                        <div class="col-8">
                            <!-- ========== AVATAR ========== -->
                            @if(isset($profile->image))
                                <h6 class="form__wizard__label">Avatar</h6>
                                <img class="img-fluid my-3 w-75" alt="Avatar" src="{{ Storage::disk('s3')->url($profile->image) }}"/>
                            @endif
                              <!-- ========== UPLOAD IMAGE ========== -->
                            <form method="POST" action="{{ route('avatar.post') }}" enctype="multipart/form-data">
                                @csrf

                                <label class="form__wizard__label" for="image" class="text-break">{{ __('Upload Image') }}</label>
                                <input
                                    type="file" {{ (!empty($profile->image)) ? "disabled" : ''}}
{{--                                    accept="image/x-png,image/gif,image/jpeg, image/svg image/gif"--}}
                                    class="form-control-file @error('image') is-invalid @enderror"
                                    name="image"
                                    id="image"
                                    aria-describedby="fileHelp">
                                <small
                                    id="fileHelp"
                                    class="form-text text-muted">
                                    Please upload a valid image file. Size of image should not be more than 2MB.
                                </small>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <!-- ========== NEXT BUTTON ========== -->
                            @if(isset($profile->image))
                                <div class="my-3">
                                    <button type="submit" class="form__wizard__btn form__wizard__btn--orange ">
                                        {{ __('Next') }}
                                    </button>
                                </div>
                            @else
                                <div class="text-right">
                                    <button type="submit" class="form__wizard__btn form__wizard__btn--orange ">
                                        {{ __('Next') }}
                                    </button>
                                </div>
                            @endif
                            </form>
                            <!-- ========== REMOVE AVATAR BTN ========== -->
                            @if(isset($profile->image))
                                <form method="POST" action="{{ route('avatar.destroy') }}">
                                    @method('DELETE')
                                    @csrf

                                    <button type="submit" class="form__wizard__btn form__wizard__btn--red mr-3 ">Remove Avatar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
