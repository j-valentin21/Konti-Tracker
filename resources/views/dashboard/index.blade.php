@extends('layouts.master')

@section('title', "Dashboard")

@section('class', 'dashboard')

@section('id', 'app')

@section('body-header')
    @include("layouts.navbar.dashboard")
@endsection

@section('body-content')

    <div class="container-fluid">
        <!-- ========== SIDEBAR START ========== -->
        <div class="sidebar d-lg-block collapse" id="sidebar-menu">
            <div class="h-100 m-3">
                <!-- ========== SIDEBAR HEADER ========== -->
                <div class="text-center py-4">
                    <div class="sidebar__img">
                        <img src="{{ asset('img/vacation.jpg') }}" alt="vacation" class="sidebar__avatar mx-auto rounded-circle">
                    </div>
                    <div class="mt-3">
                        <a href="#" class=" text-white sidebar__name">Joel</a>
                        <p class="sidebar__text mb-0 ">Water Spider</p>
                    </div>
                </div>
                <!-- ========== SIDEBAR MENU ========== -->
                <div>
                    <ul class=" list-unstyled">
                        <li class="sidebar__menu">Menu</li>

                        <li>
                            <a href="calendar.html" class=" sidebar__link hover__black">
                                <svg class="icons icons--sidebar">
                                    <use href="svg/sprite.svg#icon-calendar"></use>
                                </svg>
                                <span>Calendar</span>
                            </a>
                        </li>

                        <li>
                            <a href="notifications.html" class=" sidebar__link hover__black">
                                <svg class="icons icons--sidebar">
                                    <use href="svg/sprite.svg#icon-bell"></use>
                                </svg>
                                <span>Notifications</span>
                            </a>
                        </li>

                        <li>
                            <a href="pto.html" class=" sidebar__link hover__black">
                                <svg class="icons icons--sidebar">
                                    <use href="svg/sprite.svg#icon-airplane"></use>
                                </svg>
                                <span>Request PTO day</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ========== SIDEBAR END ========== -->

        <!-- ========== MAIN CONTENT ========== -->
        <div class="dashboard__main">
            <div class="dashboard__main-content">
                <!-- ========== ROW START/OVERVIEW ========== -->
                <div class="row mb-3">
                    <div class="col-xl-3">
                        <div class="card dashboard__card mb-4">
                            <div class="card-body">
                                <h4 class="card-title dashboard__card__title  mb-4">Overview</h4>
                                <div class="pb-3 border__bottom--grey">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <p class="mb-2 dashboard__card__text ">PTO</p>
                                            <h4 class="my-3 text-white">19</h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-right">
                                                <a class="btn__step mb-2" href="add-website-here">+</a>
                                                <a class="btn__step" href="add-website-here">-</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn__submit">Submit</button>
                                    </div>
                                </div>
                                <div class="py-3 border__bottom--grey">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <p class="mb-2 dashboard__card__text">Points</p>
                                            <h4 class="my-3 text-white">4</h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-right">
                                                <a class="btn__step mb-2" href="add-website-here">+</a>
                                                <a class="btn__step" href="add-website-here">-</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn__submit">Submit</button>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <p class="my-4 dashboard__card__text">Pending</p>
                                        <h4 class="my-3 text-white">3</h4>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-right">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9">
                        <div class="card dashboard__card">
                            <div class="card-body">
                                <h4 class="card-title dashboard__card__title mb-4">PTO usage</h4>
                                <div class="dashboard__card__chart">
                                    <canvas id="barChart"></canvas>
                                </div>
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
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- ========== PENDING ========== -->
                    <div class="col-lg-6 mb-4">
                        <div class="card dashboard__card">
                            <div class="card-body">
                                <h4 class="card-title dashboard__card__title mb-4">Pending</h4>
                                <canvas id="pieChart"></canvas>
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

                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <div class="media-body overflow-hidden">
                                                            <h5 class=" mb-1 text-white">Paul</h5>
                                                            <p class="text-truncate mb-0 dashboard__card__text border__bottom--grey mb-2">Hey! there I'm available</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <div class="media-body overflow-hidden">
                                                            <h5 class=" mb-1 text-white">Brody</h5>
                                                            <p class="text-truncate mb-0 dashboard__card__text border__bottom--grey mb-4">This day is available</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <div class="media-body overflow-hidden">
                                                            <h5 class=" mb-1 text-white">Isaiah</h5>
                                                            <p class="text-truncate mb-0 dashboard__card__text border__bottom--grey mb-4">This day is available</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>

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
                                        <h4 class="card-title dashboard__card__title mb-4">PTO/Points activity</h4>

                                        <div class="table-responsive">
                                            <table class="table table-centered">
                                                <thead>
                                                <tr class="dashboard__card__title">
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">Supervisor name</th>
                                                    <th scope="col">PTO time requested</th>
                                                    <th scope="col" colspan="2">Status</th>
                                                </tr>
                                                </thead>
                                                <tbody class="dashboard__card__text">
                                                <tr>
                                                    <td>08/26/2020</td>
                                                    <td>
                                                        <a href="#" class="dashboard__card__text">8:20AM</a>
                                                    </td>
                                                    <td>Werner Berlin</td>
                                                    <td>$ 125</td>
                                                    <td><span class="badge">Paid</span></td>
                                                </tr>
                                                <tr>
                                                    <td>08/24/2020</td>
                                                    <td>
                                                        <a href="#" class="dashboard__card__text">3:30PM</a>
                                                    </td>
                                                    <td>Robert Jordan</td>
                                                    <td>$ 118</td>
                                                    <td><span class="badge">Chargeback</span></td>
                                                </tr>
                                                <tr>
                                                    <td>08/15/2020</td>
                                                    <td>
                                                        <a href="#" class="dashboard__card__text">10:20AM</a>
                                                    </td>
                                                    <td>Daniel Finch</td>
                                                    <td>$ 115</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>08/15/2020</td>
                                                    <td>
                                                        <a href="#" class="dashboard__card__text">2:45PM</a>
                                                    </td>
                                                    <td>James Hawkins</td>
                                                    <td>$ 121</td>
                                                    <td><span class="badge">Refund</span></td>
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
    <!-- SCRIPTS -->
@section('body-scripts')
    <script src="{{ asset('js/scripts/chart.js') }}"></script>
@endsection
