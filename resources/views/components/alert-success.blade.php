<div class="col-sm-12">
    <div class="alert fade alert__success alert-dismissible text-left brk-library-rendered rendered show">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true" class="mb-5">
                <svg class="alert__icon alert__icon--x">
                    <use href="{{ asset('svg/sprite.svg#icon-times') }}"></use>
                </svg>
            </span>
            <span class="sr-only">Close</span>
        </button>
        <span class="alert__start">
            <svg class="alert__icon alert__icon--check">
                <use href="{{ asset('svg/sprite.svg#icon-check_circle_outline') }}"></use>
            </svg>
        </span>
       {{$slot}}
    </div>
</div>

