import flatpickr from "flatpickr";
import "flatpickr/dist/l10n/id";
import "flatpickr/dist/flatpickr.css";

import EmblaCarousel from 'embla-carousel'

document.addEventListener("DOMContentLoaded", () => {

    flatpickr("#date-picker", {
        locale: "id",
        enableTime: false,
        dateFormat: "d F Y",
        inline: true
    });

    const emblaNode = document.querySelector(".embla__viewport");
    const embla = EmblaCarousel(emblaNode, { loop: false });

    const emblaThumbsNode = document.querySelector(".embla-thumbs__viewport");
    const emblaThumbs = EmblaCarousel(emblaThumbsNode, { loop: false });

    const slides = emblaThumbs.slideNodes();
    const updateActiveThumbnail = (index) => {
        slides.forEach((slide) => {
            slide.classList.remove('slide_active'); // Remove border from all thumbnails
        });
        slides[index].classList.add('slide_active'); // Add border to the active thumbnail
    };

    embla.on("select", () => {
        const selectedIndex = embla.selectedScrollSnap();
        emblaThumbs.scrollTo(selectedIndex);
        updateActiveThumbnail(selectedIndex); // Update active thumbnail border
    });


    slides.forEach((slide, index) => {
        slide.addEventListener("click", () => {
            embla.scrollTo(index);
            updateActiveThumbnail(index);
        });
    });

    updateActiveThumbnail(0);

});