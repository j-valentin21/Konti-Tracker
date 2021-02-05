//INTERSECTION OBSERVER-INDEX
window.onload = function() {
//DOM selection
    const caraImg = document.querySelector(".carousel-inner");
    const nav = document.querySelector(".navbar__logo");
    const navbar = document.querySelector("#navbar__bg");
    const home = document.querySelector(".homepage__bg");
    const cardLeft = document.querySelectorAll(".card-animation__left");
    const cardRight = document.querySelectorAll(".card-animation__right");
//Options for new observer object
    const options = {
        root: null,
        rootMargin: '0px 0px 0px 0px',
        threshold: 0
    };

//Observer for navigation logo
    observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.intersectionRatio > 0) {
                nav.classList.add("navbar__alt");
                home.classList.add("homepage__bgcolor");
                navbar.classList.add("navbar__bg");
            } else {
                nav.classList.remove("navbar__alt");
                home.classList.remove("homepage__bgcolor");
                navbar.classList.remove("navbar__bg");
            }
        });
    }, options);
    observer.observe(caraImg);

//Observer for konti-tracker(left)
//Options for new observer object
    const option = {
        root: null,
        rootMargin: '-100px 0px -200px 0px',
        threshold: 0
    };
    observe = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.animation = `slideInLeft 1.75s ease, gradient 7.5s ease infinite`;
                entry.target.style.visibility = "visible";
            } else {
                entry.target.style.animation = `none`;
                entry.target.style.visibility = "hidden";
            }
        });
    }, option);

    cardLeft.forEach(image => {
        observe.observe(image)
    })
//Observer for konti-card(right)
//Options for new observer object
    observeRight = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.animation = `slideInRight 1.75s ease, gradient 7.5s ease infinite`;
                entry.target.style.visibility = "visible";
            } else {
                entry.target.style.animation = `none`;
                entry.target.style.visibility = "hidden";
            }
        });
    }, option);

    cardRight.forEach(image => {
        observeRight.observe(image)
    })
}



