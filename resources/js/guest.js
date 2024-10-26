import "./bootstrap";
import Alpine from "alpinejs";
import AOS from "aos";
import "aos/dist/aos.css";
// import "./order";

window.Alpine = Alpine;
Alpine.start();
AOS.init();

document.addEventListener("DOMContentLoaded", () => {
    const carousel = document.getElementById("carousel");
    const nextButton = document.getElementById("next");
    const prevButton = document.getElementById("prev");
    const carouselItems = document.querySelectorAll(".carousel-item");

    if (!carousel || !nextButton || !prevButton || !carouselItems.length)
        return;

    const scrollCarousel = (direction) => {
        carousel.scrollBy({
            left: direction * carousel.clientWidth,
        });
        setTimeout(updateButtonState, 300);
    };

    const updateButtonState = () => {
        prevButton.disabled = carousel.scrollLeft === 0;
        nextButton.disabled =
            carousel.scrollLeft + carousel.clientWidth >= carousel.scrollWidth;
        prevButton.classList.toggle("disabled", prevButton.disabled);
        nextButton.classList.toggle("disabled", nextButton.disabled);
    };

    nextButton.addEventListener("click", () => scrollCarousel(1));
    prevButton.addEventListener("click", () => scrollCarousel(-1));

    const observer = new IntersectionObserver(
        { root: carousel, rootMargin: "0px", threshold: 0.5 }
    );

    carouselItems.forEach((item) => observer.observe(item));
    updateButtonState();
});
