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
                    </x-slot>
                    <tr class="dashboard__table__row">
                        <td>January</td>
                        <td class="dashboard__table__cell">20</td>
                    </tr>
                </x-dashboard-table>
            </div>
        </div>
    </div>
@endsection
