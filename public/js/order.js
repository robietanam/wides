function ticketApp(ticketPrice, discount, packageId, crsfToken, urlPost, payment, user) {
    const today = new Date();
    const dates = Array.from({ length: 5 }, (_, i) => {
        const date = new Date(today);
        date.setDate(today.getDate() + i);
        return {
            dateString: date.toLocaleDateString('id-ID', { day: 'numeric' }),
            monthString: date.toLocaleDateString('id-ID', { month: 'short' }),
            value: date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })
        };
    });
    function parseDate(inputDate) {
        const months = {
            'Januari': '01',
            'Februari': '02',
            'Maret': '03',
            'April': '04',
            'Mei': '05',
            'Juni': '06',
            'Juli': '07',
            'Agustus': '08',
            'September': '09',
            'Oktober': '10',
            'November': '11',
            'Desember': '12'
        };

        // Split the input date string into parts
        const parts = inputDate.split(' '); // ['5', 'Oktober', '2024']

        // Extract day, month, and year from the parts
        const day = parts[0].padStart(2, '0'); // Ensures day is two digits
        const month = months[parts[1]]; // Get month number
        const year = parts[2]; // Year

        // Return formatted date string in YYYY-MM-DD format
        return `${year}-${month}-${day}`;
    }

    return {
        isMobile: window.innerWidth <= 768,
        ticketQuantity: 1,
        nama: user?.name ?? "",
        email: user?.email ?? "",
        noTelp: user?.phone ?? "",
        currentStep: 1,
        loading: false,
        showErrorToast: false,
        errorMessage: 'Terjadi Kesalahan',
        tanggalKunjungan: dates[0].value,
        ticketPrice: ticketPrice,
        discountAmount: discount,
        amount: ticketPrice,
        discount: discount,
        packageId: packageId,
        dates,
        paymentMethod: null,
        paymentName: null,
        transactionId: null,
        openIndex: "Cash",
        paymentMethods: payment,
        updateAmount() {
            const discountedPrice = this.ticketPrice - (this.ticketPrice * this.discount / 100);
            this.amount = discountedPrice * this.ticketQuantity;
            this.discountAmount = discountedPrice
        },
        init() {
            console.log(payment)
            this.$watch('ticketQuantity', () => {
                if (this.ticketQuantity > 30) {
                    alert('Jumlah tiket tidak boleh lebih dari 30.');
                    this.ticketQuantity = 30;
                }
                this.updateAmount();
            });
            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth <= 768;
            });
            this.updateAmount();
        },
        submitOrder() {
            if (!this.tanggalKunjungan || this.ticketQuantity < 1) {
                alert('Pastikan jumlah tiket dan tanggal kunjungan telah dipilih.');
                return;
            }

            if (this.nama.trim() === '') {
                alert('Nama tidak boleh kosong.');
                return;
            }

            if (this.email.trim() === '') {
                alert('Email tidak boleh kosong.');
                return;
            }

            if (this.noTelp.trim() === '') {
                alert('Nomor telepon tidak boleh kosong.');
                return;
            }

            if (!this.paymentMethod) {
                alert('Silakan pilih metode pembayaran.');
                return;
            }


            const data = {
                _token: crsfToken,
                name: this.nama,
                email: this.email,
                noTelp: this.noTelp,
                ticket_quantity: this.ticketQuantity,
                payment: this.paymentMethod,
                visit_date: parseDate(this.tanggalKunjungan),
                package_id: this.packageId,
            };
            this.loading = true;
            this.currentStep = 3;
            fetch(urlPost, {
                method: 'POST',
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    "X-Requested-With": "XMLHttpRequest",
                    'X-CSRF-TOKEN': crsfToken
                },
                body: JSON.stringify(data)
            })
                .then(response => {

                    console.log(data)
                    console.log(response)
                    return response.json();
                })
                .then(resp => {
                    this.loading = false
                    if (resp.success) {
                        this.currentStep = 4;
                        console.log(resp)
                        this.transactionId = resp.data.transaction_code;
                        window.location.href = `/transaksi/${resp.data.transaction_code}`; // Redirect to the transaction details page
                    } else {
                        this.errorMessage = resp.message;
                        this.showErrorToast = true;
                        setTimeout(() => { this.showErrorToast = false }, 7000); // Auto-hide after 7 seconds
                    }
                })
                .catch(error => {
                    console.log(error)
                    this.loading = false
                    this.currentStep = 2;
                    this.errorMessage = 'Terjadi kesalahan, coba lagi.';
                    this.showErrorToast = true;
                    setTimeout(() => { this.showErrorToast = false }, 7000); // Auto-hide after 7 seconds
                });
        }
    };
}
