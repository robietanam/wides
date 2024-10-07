import flatpickr from "flatpickr";
import "flatpickr/dist/l10n/id";
import "flatpickr/dist/flatpickr.css";
document.addEventListener("DOMContentLoaded", () => {

    flatpickr("#date-picker", {
        locale: "id",
        enableTime: false,
        dateFormat: "d F Y",
        inline: true
    });

});