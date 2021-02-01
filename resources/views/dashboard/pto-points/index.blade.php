@extends('layouts.master')

@section('title', "PTO/Points data")

@section('class', 'dashboard')

@section('content', "PTO/POINTS DATA")

@section('id', 'app')

@section('body-header')
    @include("layouts.navbar.dashboard")
@endsection

@section('body-content')
    <div class="container-fluid">
        <x-dash-sidebar/>
        <div class="dashboard__main">
            <div class="dashboard__main-content  dashboard__main-content--pto">
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
                <x-dashboard-table>
                    <x-slot name="table_head">
                        <thead class="dashboard__table__head dashboard__table__head--orange">
                    </x-slot>
                    <x-slot name="table_row">
                        <th>Month</th>
                        <th>PTO Used</th>
                        <th>Points Used</th>
                    </x-slot>
                    <x-slot name="table_body">
                        <strong class="text-danger">{{ $errors->first('pto_used.*') }}</strong>
                        <strong class="text-danger">{{ $errors->first('points_used.*') }}</strong>
                    @foreach ($results as $result)
                            <tr class="dashboard__table__row">
                                <td class="font-weight-bolder">{{$result[1]}}</td>
                                <td  class="dashboard__table__cell">
                                    <input class="form-control"
                                           name="pto_used[]"
                                           step=".25"
                                           type="number"
                                           min="0"
                                           max="40"
                                           value="{{ $result[0] }}"
                                           required/>
                                </td>
                                <td class="dashboard__table__cell">
                                    <input class="form-control"
                                           name="points_used[]"
                                           type="number"
                                           min="0"
                                           max="15"
                                           value="{{ $result[2] }}"
                                           required/>
                                </td>
                            </tr>
                    @endforeach
                    </x-slot>
                    <x-slot name="table_button">
                        <div class="text-center">
                            <button type="submit" class="form__wizard__btn form__wizard__btn--orange mt-4">Update</button>
                        </div>
                    </x-slot>
                </x-dashboard-table>
            </div>
        </div>
    </div>
    <request-pto-form :pto="{{ auth()->user()->profile->pto }}"/>
@endsection
