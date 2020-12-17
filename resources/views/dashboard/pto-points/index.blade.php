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
                @foreach ($results as $result)
                        <tr class="dashboard__table__row">
                            <td>{{$result[1]}}</td>
                            <td contenteditable="true" id="hello" class="dashboard__table__cell">{{ $result[0] }}</td>
                            <td contenteditable="true" class="dashboard__table__cell">{{ $result[2] }}</td>
                        </tr>
                @endforeach
                </x-dashboard-table>
            </div>
        </div>
    </div>
@endsection
@section('body-scripts')
    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
        crossorigin="anonymous">
    </script>
    <script src="{{ asset('jquery/table_cell.js') }}"></script>
@endsection
