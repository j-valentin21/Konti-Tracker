@extends('layouts.master')
@section('title', "Contact-Us")

@section('body-content')
    <div class="contact-us">
        <div class="contact-us__container">
            <div class="contact-us__form">
                @if(session('errorMsg'))
                    <div class="text-center">
                        <strong class="font__weight-semibold text-white bg-danger p-1">{{ session('errorMsg') }}</strong>
                    </div>
                @endif
                <form method="POST" action="{{ route('contact-us.create') }}">
                    @csrf
                    <a href="/">
                        <svg class="contact-us__arrow">
                            <use href="{{ asset('svg/sprite.svg#icon-arrow-left') }}"></use>
                        </svg>
                    </a>
					<span class="contact-us__title">
						Contact Us
					</span>
                    <div class="contact-us__form-input">
                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                        <input class="contact-us__input" type="text" name="name" placeholder="">
                        <span class="contact-us__focus" data-placeholder="NAME"></span>
                    </div>
                    <div class="contact-us__form-input">
                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                        <input class="contact-us__input" type="email" name="email" placeholder="">
                        <span class="contact-us__focus" data-placeholder="EMAIL"></span>
                    </div>
                    <div class="contact-us__form-input">
                        <strong class="text-danger">{{ $errors->first('message') }}</strong>
                        <textarea class="contact-us__input contact-us__textarea" name="message" placeholder=""></textarea>
                        <span class="contact-us__focus" data-placeholder="MESSAGE"></span>
                    </div>
                    <div class="contact-us__btn-container">
                        <button class="contact-us__btn">
                            Send Your Message
                        </button>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label for="botcheck">Gender
                            <input type="checkbox" name="botcheck" id="botcheck" />
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
