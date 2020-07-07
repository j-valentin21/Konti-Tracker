@extends('layouts.app')


    <!-- TITLE -->
    <title>Konti-Tracker</title>

  <body class="homepage__bg">
     <!-- NAVBAR -->
    <nav id="navbar__bg" class="navbar navbar-expand navbar sticky-top bg-white pl-5">
        <a class="navbar-brand navbar__logo" href="#"><img class="navbar__logo--img" src="img/konti_logo.png" alt="Konti-Tracker logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link navbar__link hover__black text-center" href="#">Register <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link navbar__link hover__black" data-toggle="modal" href="#exampleModalCentered">Sign In</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- MODAL -->
    <section class="modal" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header modal__header">
                    <h5 class="modal-title" id="exampleModalCenteredLabel">Sign In</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal__body">
                    <form>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Username</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="username">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Password</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="password">
                        </div>
                        <a href="#">Forgot password/username?</a>
                        <div class="mt-2 d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2 modal__button" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary modal__button">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-11 mx-auto mb-5">
                <!-- CAROUSEL -->
                <header id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div  class="carousel-inner carousel__height">
                        <figure class="carousel-item active">
                            <img src="img/car.jpg" class="d-block w-100 carousel__height--img" alt="car">
                            <figcaption class="carousel-caption mb-5">
                                <h1 class="carousel__heading text-center">Konti tracker is now available.</h1>
                                <p class="carousel__text lead">Keep track of all your PTO usage</p>
                            </figcaption>
                        </figure>
                        <figure class="carousel-item">
                            <img src="img/dashboard.jpg" class="d-block w-100 carousel__height--img" alt="motor">
                            <figcaption class="carousel-caption mb-5">
                                <h1 class="carousel__heading text-center">Peace of mind</h1>
                                <p class="carousel__text lead">All PTO information can be tracked here</p>
                            </figcaption>
                        </figure>
                        <figure class="carousel-item">
                            <img src="img/vacation.jpg" class="d-block w-100 carousel__height--img"  alt="vacation">
                            <figcaption class="carousel-caption mb-5">
                                <h1 class="carousel__heading">Enjoy life</h1>
                                <p class="carousel__text lead">Save your PTO days for your next beautiful vacation.</p>
                            </figcaption>
                        </figure>
                    </div>
                    <!-- CAROUSEL CONTROLS -->
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next actvie" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon active" aria-hidden="true"></span>
                    <span class="sr-only active">Next</span>
                    </a>
                </header>
                <!-- PTO JUMBOTRON -->
                <section class="jumbotron mt-4 mt-sm-0 pto">
                    <img class="img-fluid pto__img " src="img/new.jpg" alt="'New' icon">
                    <div class="text-center">
                        <h3 class="pto__heading">PTO Purchase Program</h3>
                        <p class="lead">You can purchase up to 10 days of additional PTO</p>
                    </div>
                </section>
                <section class="container-fluid">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-5">
                                <!-- KONTI-CARDS -->
                            <div class="konti-cards card card-animation__left">
                                <img class="card-img-top konti-card__img my-3 w-25 mx-auto"  src="svg/car-parts.svg" alt="tracker">
                                <div class="card-body">
                                    <h4 class="card-title">PTO Tracking software</h4>
                                    <p class="card-text">
                                        Your attendance, years of service, scheduled/unschduled time all tracked in one location.
                                    </p>
                                </div>
                            </div>
                            <div class="konti-cards card card-animation__left">
                                <img class="card-img-top konti-card__img mx-auto my-3 w-25" src="svg/brake-disc.svg" alt="brake disc">
                                <div class="card-body">
                                    <h4 class="card-title">No more PTO/attendance sheet request</h4>
                                    <p class="card-text">
                                        Put a <span class="font-weight-bolder">stop</span> on tracking everything on paper. Let the Konti-Tracker do all the work.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 my-5 my-sm-1 ">
                            <div class="konti-cards card card-animation__right">
                                <img class="card-img-top konti-card__img my-4  w-25 mx-auto"  src="svg/graph.svg" alt="graph">
                                <div class="card-body">
                                    <h4 class="card-title display-5">Graphs</h4>
                                    <p class="card-text">
                                        Beautifully designed graphs to view all your customized data.
                                    </p>
                                </div>
                            </div>
                            <div class="konti-cards card card-animation__right">
                                <img class="card-img-top konti-card__img my-3 w-25 mx-auto"  src="svg/car-parts.svg" alt="tracker">
                                <div class="card-body">
                                    <h4 class="card-title">PTO Tracking software</h4>
                                    <p class="card-text text-dark">
                                        Your attendance, years of service, scheduled/unschduled time all tracked in one location.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- FOOTER -->
                <footer class="footer d-flex flex-wrap align-content-end">
                    <div class="container">
                        <h2 class="footer__primary text-center mt-4">SITE LINKS</h2>
                        <div class="d-flex justify-content-around">
                            <a class="footer__link hover__black" href="#">HOME</a>
                            <a class="footer__link hover__black" href="#">SIGNUP/REGISTER</a>
                            <a class="footer__link hover__black" href="#">SIGN IN</a>
                            <a class="footer__link hover__black" href="#">CONTACT US</a>
                        </div>
                        <div class="d-flex justify-content-end">
                            <p class="footer__copyright">
                                &copy; Copyright 2020 by Konti-tracking systems.
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <!-- SCRIPTS -->
     <script src="{{ asset('js/scripts/intersection_observer/index.js') }}"></script>
  </body>

