const { createApp } = Vue;

document.addEventListener("DOMContentLoaded", () => {

    createApp({

        data() {
            return {
                showHero: false,
                showGaleri: false,
                showFilosofi: false,

                tanggal: '',
                kapasitas: null,

                selectedImage: null,
                selectedTitle: '',
                selectedDesc: '',

                rating: 0,
                hoverRating: 0,
                showToast: false,
                showError: false,
                errorMessage:'',

                form : {
                    nama:'',
                    komentar:''
                },

                reviews: []
            }
        },

        mounted() {
            console.log("USER APP JALAN ✅");

            const el = document.getElementById('initialReview');
            if (el) {
                this.reviews = JSON.parse(el.textContent);
            }

            console.log("DATA REVIEW:", this.reviews); // debug

            this.selectedImage = null;
            this.selectedTitle = '';
            this.selectedDesc = '';

            this.showHero = true;

            window.addEventListener('scroll', this.handleScroll);
            this.handleScroll();
        },

        methods: {

            // ================= GALERI SCROLL =================
            scrollGaleri(direction) {
                const el = this.$refs.galeriScroll;
                if (!el) return;

                const scrollAmount = 300; // jarak geser

                el.scrollBy({
                    left: direction * scrollAmount,
                    behavior: 'smooth'
                });
            },

            // (dipanggil dari HTML, tapi tidak dipakai lagi)
            startAutoSlide() {},
            stopAutoSlide() {},

            // ================= SCROLL EFFECT =================
            handleScroll() {
                this.handleNavbar();
                this.handleGaleri();
                this.handleFilosofi();
                this.handleActiveNav();
                this.handleFade();
            },

            handleNavbar() {
                const navbar = document.querySelector('.navbar');
                if (!navbar) return;

                navbar.classList.toggle('scrolled', window.scrollY > 50);
            },

            handleActiveNav(){

            const sections=document.querySelectorAll("section[id]");
            const navLinks=document.querySelectorAll(".nav-link");

            let current="";

            const scrollPos=window.scrollY + 180;

            sections.forEach(section=>{

            const top=section.offsetTop;
            const bottom=top + section.offsetHeight;

            if(
            scrollPos >= top &&
            scrollPos < bottom
            ){
            current=section.id;
            }

            });

            if(
            window.innerHeight + window.scrollY
            >= document.body.offsetHeight - 50
            ){
            current="lokasi";
            }


            navLinks.forEach(link=>{

            link.classList.remove("active");

            if(link.getAttribute("href")==="#" + current){
            link.classList.add("active");
            }

            });

            },

            handleGaleri() {
                const galeri = document.getElementById('galeri');
                if (!galeri) return;

                const pos = galeri.getBoundingClientRect().top;

                if (pos < window.innerHeight - 100) {
                    this.showGaleri = true;
                }
            },

            handleFade() {
                const sections = document.querySelectorAll('.fade-section');

                sections.forEach(el => {
                    const pos = el.getBoundingClientRect().top;

                    if (pos < window.innerHeight - 100) {
                        el.classList.add('show');
                    }
                });
            },

            handleFilosofi() {
                const filosofi = document.querySelector('.filosofi-section');
                if (!filosofi) return;

                const pos = filosofi.getBoundingClientRect().top;

                if (pos < window.innerHeight - 100) {
                    this.showFilosofi = true;
                }
            },

            // ================= MODAL =================
            openImage(img, title, desc) {
                this.selectedImage = img;
                this.selectedTitle = title;
                this.selectedDesc = desc;
            },

            closeImage() {
                this.selectedImage = null;
                this.selectedTitle = '';
                this.selectedDesc = '';
            },

            // ================= BOOKING =================
            cekKapasitas() {
                if (!this.tanggal) return;

                fetch(`index.php?page=kapasitas&tanggal=${this.tanggal}`)
                    .then(res => res.json())
                    .then(data => {
                        this.kapasitas = data;
                    })
                    .catch(() => {
                        this.kapasitas = null;
                    });
            },

            async submitReview() {

            if (this.rating === 0) {
                alert('Pilih rating dulu!');
                return;
            }

            try {
                const response = await fetch('index.php?page=tambahReview', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        nama: this.form.nama,
                        komentar: this.form.komentar,
                        rating: this.rating
                    })
                });

                const result = await response.text();

                // tampilkan toast
                this.showToast = true;

                this.reviews.unshift({
                    nama: this.form.nama,
                    komentar: this.form.komentar,
                    rating: this.rating
                });

                // reset form
                this.form.nama = '';
                this.form.komentar = '';
                this.rating = 0;

                // hilangkan toast setelah 3 detik
                setTimeout(() => {
                    this.showToast = false;
                }, 3000);

            } catch (error) {
                console.error(error);
                alert('Gagal kirim review');
            }

                this.reviews = JSON.parse(
                document.getElementById('initialReview').textContent
                );
            },

            submitBooking(event) {

                const form = new FormData(event.target);

                fetch('index.php?page=proses_booking', {
                    method: 'POST',
                    body: form
                })

        .then(res => res.json())
        .then(res => {

            if (res.status === 'error') {

                this.errorMessage = res.message;
                this.showError = true;

                setTimeout(() => {
                    this.showError = false;
                }, 3000);

                return;
            }

            if (res.status === 'success') {
                this.showToast = true;

                setTimeout(() => {
                    window.location.href = res.url;
                }, 1500);
            }

        })
            .catch(() => {
                alert("Terjadi kesalahan");
            });
        }

        },

        watch: {
            selectedImage(val) {
                document.body.style.overflow = val ? 'hidden' : 'auto';
            }
        }

    }).mount('#app');

});