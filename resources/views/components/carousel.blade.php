<!-- CAROUSEL -->
<header id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <section class="carousel-inner carousel__height">
        <figure class="carousel-item active">
            <img src="{{ asset('img/car.jpg') }}" class="d-block w-100 carousel__height--img" alt="car">
            <figcaption class="carousel-caption mb-5">
                <h1 class="carousel__heading text-center">Konti tracker is now available.</h1>
                <p class="carousel__text lead">Keep track of all your PTO usage</p>
            </figcaption>
        </figure>
        <figure class="carousel-item">
            <img src="{{ asset('img/dashboard.jpg') }}" class="d-block w-100 carousel__height--img" alt="motor">
            <figcaption class="carousel-caption mb-5">
                <h1 class="carousel__heading text-center">Peace of mind</h1>
                <p class="carousel__text lead">All PTO information can be tracked here</p>
            </figcaption>
        </figure>
        <figure class="carousel-item">
            <img src="{{ asset('img/vacation.jpg') }}" class="d-block w-100 carousel__height--img"  alt="vacation">
            <figcaption class="carousel-caption mb-5">
                <h1 class="carousel__heading">Enjoy life</h1>
                <p class="carousel__text lead">Save your PTO days for your next beautiful vacation.</p>
            </figcaption>
        </figure>
    </section>
    <!-- CAROUSEL CONTROLS -->
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next active" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon active" aria-hidden="true"></span>
        <span class="sr-only active">Next</span>
    </a>
</header>

