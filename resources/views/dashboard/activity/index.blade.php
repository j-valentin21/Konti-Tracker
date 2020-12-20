@extends('layouts.master')

@section('title', "Dashboard Activity")

@section('class', 'dashboard')

@section('content', "DASHBOARD ACTIVITY")

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
                        <thead class="dashboard__table__head dashboard__table__head--black">
                    </x-slot>

                    <x-slot name="table_row">
                        <th>Date</th>
                        <th>Time</th>
                        <th>PTO Used</th>
                        <th>Points</th>
                        <th>Pending</th>
                        <th>Reason For Request</th>
                        <th>Supervisor Name</th>
                        <th>Status</th>
                    </x-slot>

                    <x-slot name="table_body">

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
