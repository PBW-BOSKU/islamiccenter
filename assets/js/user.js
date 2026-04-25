const { createApp } = Vue;

document.addEventListener("DOMContentLoaded", () => {
    if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
}

    window.scrollTo(0,0);

    createApp({

        data() {
            return {
                showHero: false,
                showGaleri: false,
                showFilosofi: false,

                tanggal: '',
                kapasitas: null,

                selectedImage: '',
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

            console.log("DATA REVIEW:", this.reviews);

            window.scrollTo({
                top:0,
                left:0,
                behavior:'instant'
            });

            this.showHero = true;

            window.addEventListener(
                'scroll',
                this.handleScroll,
                { passive:true }
            );

            this.$nextTick(()=>{

                window.scrollTo(0,0);

                this.handleScroll();

                this.initReveal();

                this.initTiltCards();

                setTimeout(()=>{
                    this.showFilosofi = true;
                },150);

            });

            window.addEventListener('load',()=>{

                this.handleFilosofi();

            });

        },

        beforeUnmount() {

            window.removeEventListener(
            'scroll',
            this.handleScroll
            );

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

            startAutoSlide() {},
            stopAutoSlide() {},

            // ================= SCROLL EFFECT =================
            handleScroll() {
                this.handleNavbar();
                this.handleGaleri();
                this.handleFilosofi();
                this.handleActiveNav();
                this.handleFade();
                this.handleParallax();
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

                const filosofi = document.getElementById('filosofi');

                if (!filosofi) return;

                const rect = filosofi.getBoundingClientRect();

                if (
                    rect.top < window.innerHeight - 120
                ) {
                    this.showFilosofi = true;
                }

            },

            // ================= WOW ANIMATION =================

            initReveal(){

            const items=document.querySelectorAll(
                '.reveal,.reveal-left'
            );

            const observer=new IntersectionObserver((entries)=>{

                entries.forEach(entry=>{

                if(entry.isIntersecting){
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
            }

            });

            },{
                threshold:0.15
            });

                items.forEach(el=>{
                observer.observe(el);
            });

            },

            handleParallax(){

            const hero=document.querySelector('.cinematic-parallax');

                if(!hero) return;

                hero.style.transform=
                `translate3d(0,${window.scrollY*0.12}px,0)`;
            },

            initTiltCards(){

                document.querySelectorAll('.tilt-card')
                .forEach(card=>{

                card.addEventListener('mousemove',(e)=>{

                const r=card.getBoundingClientRect();

                const x=e.clientX-r.left;
                const y=e.clientY-r.top;

                const rx=((y/r.height)-0.5)*-6;
                const ry=((x/r.width)-0.5)*6;

                card.style.transform=
                `rotateX(${rx}deg) rotateY(${ry}deg)`;

                });

                card.addEventListener('mouseleave',()=>{

                card.style.transform='';

                });

            });

            },

            // ================= MODAL =================
            openImage(img, title, desc) {
                this.selectedImage = img;
                this.selectedTitle = title;
                this.selectedDesc = desc;
            },

            closeImage() {
                this.selectedImage = '';
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