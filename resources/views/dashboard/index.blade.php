@extends('layouts.master')

@section('title', "Dashboard")

@section('class', 'dashboard')

@section('content', "DASHBOARD")

@section('id', 'app')

@section('body-header')
    @include("layouts.navbar.dashboard")
@endsection

@section('body-content')
    <div class="container-fluid">
        <x-dash-sidebar/>
        <!-- ========== MAIN CONTENT ========== -->
        <div class="dashboard__main">
            <div class="dashboard__main-content">
                <!-- ========== ROW START/OVERVIEW ========== -->
            @if($message)
                <x-alert-success>
                    <strong class="font__weight-semibold">{{$message}}</strong>
                </x-alert-success>
            @endif
                <div class="row mb-3">
                    <div class="col-xl-3">
                        <div class="card dashboard__card mb-4">
                            <div class="card-body">
                                <incrementers :points="{{ $profile->points }}"
                                              :pto="{{ $profile->pto }}">
                                </incrementers>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h4 class="my-4 dashboard__card__header">Pending</h4>
                                        <p class="dashboard__card__value my-3 text-white mx-2">{{ $profile->pending . " " . "Days" }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9">
                        <div class="card dashboard__card">
                            <div class="card-body">
                                <h4 class="card-title dashboard__card__title mb-4">PTO usage</h4>
                                <bar-chart/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ========== END ROW ========== -->

                <!-- ========== ROW START/POINTS PER MONTH ========== -->
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card dashboard__card">
                            <div class="card-body">
                                <h4 class="card-title dashboard__card__title mb-4">Points per month</h4>
                                <line-chart/>
                            </div>
                        </div>
                    </div>
                    <!-- ========== PENDING ========== -->
                    <div class="col-lg-6 mb-4">
                        <div class="card dashboard__card">
                            <div class="card-body">
                                <h4 class="card-title dashboard__card__title mb-4">Pending</h4>
                                <pie-chart :pending="{{ $profile->pending }}" :pto="{{ $profile->pto }}" />
                            </div>
                        </div>
                    </div>
                    <!-- ========== ROW START/NOTIFICATIONS ========== -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <div class="card dashboard__card">
                                    <div class="card-body">
                                        <h4 class="card-title dashboard__card__title mb-4">Notifications</h4>
{{--                                        <ul>--}}
{{--                                            <li>--}}
{{--                                                <a href="#">--}}
{{--                                                    <div class="media">--}}
{{--                                                        <div class="media-body overflow-hidden">--}}
{{--                                                            <h5 class=" mb-1 text-white">Paul</h5>--}}
{{--                                                            <p class="text-truncate mb-0 dashboard__card__text border__bottom--grey mb-2">Hey! there I'm available</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <a href="#">--}}
{{--                                                    <div class="media">--}}
{{--                                                        <div class="media-body overflow-hidden">--}}
{{--                                                            <h5 class=" mb-1 text-white">Brody</h5>--}}
{{--                                                            <p class="text-truncate mb-0 dashboard__card__text border__bottom--grey mb-4">This day is available</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <a href="#">--}}
{{--                                                    <div class="media">--}}
{{--                                                        <div class="media-body overflow-hidden">--}}
{{--                                                            <h5 class=" mb-1 text-white">Isaiah</h5>--}}
{{--                                                            <p class="text-truncate mb-0 dashboard__card__text border__bottom--grey mb-4">This day is available</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}

                                        <div class="text-center">
                                            <a href="#" class="btn__submit">Load More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ========== PTO/POINTS ACTIVITY ========== -->
                            <div class="col-lg-8">
                                <div class="card dashboard__card mb-5">
                                    <div class="card-body">
                                        <h4 class="card-title dashboard__card__title mb-4">Dashboard Activity</h4>
                                        <div class="table-responsive">
                                            <table class="table table-centered">
                                                <thead>
                                                <tr class="dashboard__card__title">
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">PTO Used</th>
                                                    <th scope="col">Points</th>
                                                    <th scope="col">Pending</th>
                                                    <th scope="col">Reason for Request</th>
                                                    <th scope="col">Supervisor name</th>
                                                    <th scope="col" colspan="2">Status</th>
                                                </tr>
                                                </thead>
                                                <tbody class="dashboard__card__text">
                                                <tr>
                                                    <td>08/26/2020</td>
                                                    <td>John Smith</td>
                                                    <td>3.5 days</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>COVID</td>
                                                    <td class="dashboard__card__text">8:20AM</td>
                                                    <td class="badge">PENDING</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- ========== PAGINATION ========== -->
                                        <div class="mb-3">
                                            <ul class="pagination pagination-rounded justify-content-center mb-0">
                                                <li class="pagination__item">
                                                    <a class="pagination__link" href="#">Previous</a>
                                                </li>
                                                <li class="pagination__item"><a class="pagination__link" href="#">1</a></li>
                                                <li class="pagination__item active"><a class="pagination__link" href="#">2</a></li>
                                                <li class="pagination__item"><a class="pagination__link" href="#">3</a></li>
                                                <li class="pagination__item"><a class="pagination__link" href="#">Next</a></li>
                                            </ul>
                                        </div>
                                        <request-pto-form :pto="{{ $profile->pto }}"/>
                                    </div>
                                </div>
                            </div>
                        </div><!-- END ROW -->
                    </div> <!-- END OF CONTAINER-FLUID -->
                </div> <!-- END OF ROW -->
            </div> <!-- END OF DASHBOARD MAIN-CONTENT -->
        </div> <!-- END OF DASHBOARD-MAIN -->
    </div><!-- END OF MAIN CONTAINER-FLUID -->
@endsection
