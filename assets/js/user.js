const { createApp } = Vue;

createApp({

    data() {
        return {
            showHero: false,
            showGaleri: false,
            showFilosofi: false,

            selectedImage: null,
            selectedTitle: '',
            selectedDesc: '',

            rating: 0,
            hoverRating: 0
        }
    },

    mounted() {
        console.log("USER APP JALAN");

        this.showHero = true;

        window.addEventListener('scroll', this.handleScroll);
        this.handleScroll();
    },

    beforeUnmount() {
        window.removeEventListener('scroll', this.handleScroll);
    },

    methods: {

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

        handleActiveNav() {
            const sections = document.querySelectorAll("section");
            const navLinks = document.querySelectorAll(".nav-link");

            let current = "";

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;

                if (window.scrollY >= sectionTop) {
                    current = section.getAttribute("id");
                }
            });

            navLinks.forEach(link => {
                link.classList.remove("active");

                if (link.getAttribute("href") === "#" + current) {
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

        openImage(img, title, desc) {
            this.selectedImage = img;
            this.selectedTitle = title;
            this.selectedDesc = desc;
        },

        closeImage() {
            this.selectedImage = null;
            document.body.style.overflow = 'auto';
        }

    },

    // ✅ INI YANG BENAR
    watch: {
        selectedImage(val) {
            document.body.style.overflow = val ? 'hidden' : 'auto';
        }
    }

}).mount('#app');