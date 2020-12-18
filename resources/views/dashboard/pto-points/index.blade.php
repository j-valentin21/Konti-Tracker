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
                <x-dashboard-table>
                    <x-slot name="table_head">
                        <th>Month</th>
                        <th>PTO Used</th>
                        <th>Points Used</th>
                    </x-slot>
                    <x-slot name="table_row">
                    @foreach ($results as $result)
                            <tr class="dashboard__table__row">
                                <td class="font-weight-bolder">{{$result[1]}}</td>
                                <td  class="dashboard__table__cell">
                                    <input class="form-control" name="pto_used[]" type="number" min="0" value="{{ $result[0] }}"/>
                                </td>
                                <td class="dashboard__table__cell">
                                    <input class="form-control" name="points_used[]" type="number" min="0" value="{{ $result[2] }}"/>
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
@endsection
