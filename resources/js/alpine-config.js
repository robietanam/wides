import Alpine from "alpinejs";
import { init } from "aos";

// Inisialisasi Alpine.js dan AOS setelah DOM siap
document.addEventListener("DOMContentLoaded", () => {
    window.Alpine = Alpine;
    Alpine.start();
});

// Fungsi ticketApp dari Alpine.js
function ticketApp(postlink, ticketPriceElement, discountElement, iconPayment) {
    const today = new Date();
    const dates = Array.from({ length: 5 }, (_, i) => {
        const date = new Date(today);
        date.setDate(today.getDate() + i);
        return {
            dateString: date.toLocaleDateString("id-ID", { day: "numeric" }),
            monthString: date.toLocaleDateString("id-ID", { month: "short" }),
            value: date.toLocaleDateString("id-ID", {
                day: "numeric",
                month: "long",
                year: "numeric",
            }),
        };
    });

    const ticketPrice = ticketPriceElement;
    const discount = discountElement;

    return {
        isMobile: window.innerWidth <= 768,
        currentStep: 1,
        tanggalKunjungan: dates[0].value,
        ticketQuantity: 1,
        ticketPrice: parseInt(ticketPrice),
        discount: parseInt(discount),
        amount: (parseInt(ticketPrice) - parseInt(discount)) * 1,
        dates,
        paymentMethod: "cash",
        paymentMethods: [
            { value: "cash", name: "Cash", icon: "" },
            {
                value: "Transfer Bank",
                name: "Transfer Bank",
                icon: iconPayment,
            },
        ],
        showAlert: false,
        alertStatus: "",
        alertTitle: "",
        alertDescription: "",

        updateAmount() {
            this.amount =
                (this.ticketPrice - this.discount) * this.ticketQuantity;
        },

        init() {
            this.$watch("ticketQuantity", () => this.updateAmount());

            const resizeListener = () => {
                this.isMobile = window.innerWidth <= 768;
            };
            window.addEventListener("resize", resizeListener);
        },

        submitOrder() {
            const data = {
                payment_method: this.paymentMethod,
                ticket_quantity: this.ticketQuantity,
                visit_date: this.tanggalKunjungan,
                name_package:
                    document.querySelector("#packageName").dataset.name,
            };

            fetch(postlink, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify(data),
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log("Success:", data);
                    this.showAlert = true;
                    this.alertStatus = "success";
                    this.alertTitle = "Paket berhasil dipesan!";
                    this.alertDescription =
                        "Terima kasih telah memesan paket wisata kami.";
                })
                .catch((error) => {
                    console.error("Error:", error);
                    this.showAlert = true;
                    this.alertStatus = "error";
                    this.alertTitle = "Terjadi kesalahan!";
                    this.alertDescription =
                        "Pesanan Anda gagal diproses, silakan coba lagi.";
                });
        },
    };
}

Alpine.data("ticketApp", ticketApp);
