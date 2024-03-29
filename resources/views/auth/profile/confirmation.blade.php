@extends('layouts.master')
@section('title', "Confirmation")

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
                        <!-- ========== STEPS ========== -->
                        <section class="col-sm-4">
                            <ol class="form__wizard__steps">
                                <li class="mb-4">Build Your Profile</li>
                                <li class="mb-4">Avatar</li>
                                <li class="mb-4 form__wizard__steps--active-bottom">Confirmation</li>
                            </ol>
                        </section>
                        <section class="col-sm-8">
                            <h1>Review Profile Details</h1>
                            <form action="{{ route('confirmation.store') }}" method="POST">
                                @csrf
                                <table class="table">
                                    <tr>
                                        <td>Position:</td>
                                        <td><strong>{{$profile->position ?? ""}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>PTO:</td>
                                        <td><strong>{{$profile->pto ?? ""}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Points:</td>
                                        <td><strong>{{$profile->points ?? ""}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Date of employment:</td>
                                        <td><strong>{{$profile->date_of_employment ?? ""}}</strong></td>
                                    </tr>
                                    @if(isset($profile->avatar))
                                        <tr>
                                            <td>Avatar:</td>
                                            <td>
                                                <strong>
                                                    <img class="img-fluid form__wizard__img my-3" alt="avatar" src="{{ Storage::disk('s3')->url($profile->avatar) }}"/>
                                                </strong>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                                <!-- ========== BUTTONS ========== -->
                                <div class="text-center text-sm-right">
                                    <a href="{{ route('profile.index') }}">
                                        <button type="button" class="form__wizard__btn form__wizard__btn--orange mr-2 mb-2">Back to Profile</button>
                                    </a>
                                    <a href="{{ route('avatar.index') }}">
                                        <button type="button" class="form__wizard__btn form__wizard__btn--orange mr-2 mb-2">Back to Avatar</button>
                                    </a>
                                    <a href="{{ route('confirmation.store') }}">
                                        <button type="submit" class="form__wizard__btn form__wizard__btn--black mr-2 mb-2">Create Profile</button>
                                    </a>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('body-scripts')
    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
        crossorigin="anonymous">
    </script>
    <script src="{{ asset('jquery/modal.js') }}"></script>
@endsection
