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

                showReviewModal: false,
                activeReview: null,
                selectedDescription:null,

                rating: 0,
                hoverRating: 0,
                showReviewToast: false,
                showBookingToast: false,
                showError: false,
                errorMessage:'',

                form : {
                    nama:'',
                    komentar:'',
                    sesi:'Pagi',
                    gambar:null

                },

                reviews: [],
                bookingLoading:false,
                reviewLoading:false,
                reviewButtonAnimate:false,

                reviewErrors:{
                nama:'',
                komentar:'',
                rating:''
            }
        }
    },
    
        mounted() {

            console.log("USER APP JALAN ✅");

            this.showReviewToast=false;
            this.showBookingToast=false;

            const el=document.getElementById('initialReview');

            if(el){
                this.reviews=JSON.parse(
                    el.textContent
                );
            }

            console.log(
                "DATA REVIEW:",
                this.reviews
            );


            window.scrollTo({
                top:0,
                left:0,
                behavior:'instant'
            });

            this.showHero=true;


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
                    this.showFilosofi=true;
                },150);

            });

            


            window.addEventListener(
                'load',
                ()=>{

                    this.handleFilosofi();

                }
            );



 /* ================= REVIEW + GALERI HORIZONTAL WHEEL ================= */

            this.$nextTick(()=>{
                const reviewSlider =
                    document.querySelector(
                        '.review-gallery'
                    );


                if(reviewSlider){
                    reviewSlider.addEventListener(
                        'wheel',
                        (e)=>{
                            e.preventDefault();
                            reviewSlider.scrollBy({
                                left:e.deltaY * 0.8,
                                behavior:'smooth'
                            });
                        },
                        { passive:false }
                    );
                }

                const galeriSlider =
                    document.querySelector(
                        '.galeri-review-scroll'
                    );

                if(galeriSlider){
                    galeriSlider.addEventListener(
                        'wheel',
                        (e)=>{
                            e.preventDefault();
                            galeriSlider.scrollBy({
                                left:e.deltaY * 2,
                                behavior:'smooth'
                            });
                        },
                        { passive:false }
                    );
                }
            });

/* ================= FASILITAS MODAL PREMIUM ================= */

            this.$nextTick(()=>{

                const cards = document.querySelectorAll(
                    '.fasilitas-click'
                );

                const modal = document.getElementById(
                    'fasilitasModal'
                );

                const modalImg = document.getElementById(
                    'facilityImage'
                );

                const closeBtn = document.getElementById(
                    'closeFasilitasModal'
                );

                const prevBtn = document.getElementById(
                    'prevFacility'
                );

                const nextBtn = document.getElementById(
                    'nextFacility'
                );

                const dotsWrap = document.getElementById(
                    'facilityDots'
                );

                const thumbsWrap = document.getElementById(
                    'facilityThumbs'
                );


                if(
                    !modal ||
                    !modalImg ||
                    !prevBtn ||
                    !nextBtn
                ){
                    return;
                }


                let images = [];
                let current = 0;



                function renderDots(){

                    dotsWrap.innerHTML='';

                    images.forEach((img,index)=>{

                        const dot =
                            document.createElement(
                                'span'
                            );

                        dot.className =
                            index===current
                            ? 'dot active'
                            : 'dot';

                        dot.addEventListener(
                            'click',
                            ()=>{

                                current=index;

                                showImage();

                            }
                        );

                        dotsWrap.appendChild(
                            dot
                        );

                    });

                }



                function renderThumbs(){

                    thumbsWrap.innerHTML='';

                    images.forEach((img,index)=>{

                        const thumb =
                            document.createElement(
                                'img'
                            );

                        thumb.src =
                            'assets/images/' +
                            img.trim();

                        thumb.className =
                            index===current
                            ? 'thumb active'
                            : 'thumb';

                        thumb.addEventListener(
                            'click',
                            ()=>{

                                current=index;

                                showImage();

                            }
                        );

                        thumbsWrap.appendChild(
                            thumb
                        );

                    });

                }



                function showImage(){

                    if(
                        !images.length
                    ) return;


                    modalImg.src =
                        'assets/images/' +
                        images[current].trim();


                    renderDots();

                    renderThumbs();

                }



                /* buka modal */

                cards.forEach(card=>{

                    card.addEventListener(

                        'click',

                        function(){

                            images =
                                this.dataset.gallery
                                .split(',');

                            current=0;

                            showImage();

                            modal.classList.add(
                                'active'
                            );

                            document.body.style
                                .overflow='hidden';

                        }

                    );

                });



                /* next */

                nextBtn.addEventListener(

                    'click',

                    function(e){

                        e.stopPropagation();

                        current++;

                        if(
                            current >= images.length
                        ){

                            current=0;

                        }

                        showImage();

                    }

                );



                /* prev */

                prevBtn.addEventListener(

                    'click',

                    function(e){

                        e.stopPropagation();

                        current--;

                        if(
                            current < 0
                        ){

                            current=
                                images.length-1;

                        }

                        showImage();

                    }

                );



                /* keyboard arrow */

                document.addEventListener(

                    'keydown',

                    function(e){

                        if(
                            !modal.classList.contains(
                                'active'
                            )
                        ) return;


                        if(
                            e.key==='ArrowRight'
                        ){

                            current++;

                            if(
                                current>=images.length
                            ){
                                current=0;
                            }

                            showImage();

                        }


                        if(
                            e.key==='ArrowLeft'
                        ){

                            current--;

                            if(
                                current<0
                            ){
                                current=
                                images.length-1;
                            }

                            showImage();

                        }


                        if(
                            e.key==='Escape'
                        ){

                            modal.classList.remove(
                                'active'
                            );

                            document.body.style
                                .overflow='auto';

                        }

                    }

                );



                /* close */

                closeBtn.addEventListener(

                    'click',

                    function(){

                        modal.classList.remove(
                            'active'
                        );

                        document.body.style
                            .overflow='auto';

                    }

                );



                /* klik backdrop */

                modal.addEventListener(

                    'click',

                    function(e){

                        if(
                            e.target===modal
                        ){

                            modal.classList.remove(
                                'active'
                            );

                            document.body.style
                                .overflow='auto';

                        }

                    }

                );

            });

            document.querySelectorAll('.nav-link').forEach(link=>{

                link.addEventListener('click',function(e){

                e.preventDefault();

                const sectionId=this.dataset.section;

                const target=
                document.getElementById(sectionId);

                if(!target) return;


                /* smooth scroll */
                target.scrollIntoView({
                behavior:'smooth'
                });


                /* ubah URL tanpa reload */
                history.pushState(
                {},
                '',
                '/' + sectionId
                );

                });

                });


                /* kalau buka langsung /fasilitas */
                window.addEventListener('load',()=>{

                const path=
                window.location.pathname
                .replace('/','');

                if(path){

                const target=
                document.getElementById(path);

                if(target){

                setTimeout(()=>{
                target.scrollIntoView({
                behavior:'smooth'
                });
                },300);

                }

                }

                });

                /* ================= ADMIN SHORTCUT ================= */

                document.addEventListener('keydown', function(e){

                    if(
                        e.ctrlKey &&
                        e.altKey &&
                        e.shiftKey &&
                        e.key.toLowerCase()==='m'
                    ){

                        e.preventDefault();

                        Swal.fire({
                            title:'Portal Admin',
                            text:'Masuk ke halaman login admin?',
                            icon:'question',
                            showCancelButton:true,
                            confirmButtonText:'Masuk',
                            cancelButtonText:'Batal'
                        }).then((result)=>{

                            if(result.isConfirmed){

                                window.location.href='/admin';

                            }

                        });

                    }

                });

            },

        beforeUnmount() {

            window.removeEventListener(
            'scroll',
            this.handleScroll
            );

        },
        
        methods: {

            openReviewForm(){

            this.reviewButtonAnimate=true;

            setTimeout(()=>{
            this.reviewButtonAnimate=false;
            },450); 

            this.showReviewModal=true;

            },

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

            handleReviewImage(e){

                const file = e.target.files[0];

                if(!file) return;


                if(!file.type.startsWith('image/')){

                    Swal.fire({
                        icon:'warning',
                        title:'File tidak valid',
                        text:'Hanya file gambar yang diperbolehkan'
                    });

                    e.target.value='';
                    return;
                }


                if(file.size > 2 * 1024 * 1024){

                    Swal.fire({
                        icon:'warning',
                        title:'File terlalu besar',
                        text:'Maksimal ukuran gambar 2MB'
                    });

                    e.target.value='';
                    return;
                }

                this.form.gambar=file;

            },

            openReviewDetail(r){
                this.activeReview=r;
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

                const sesi =
                    document.querySelector(
                        'input[name="sesi"]:checked'
                    )?.value || 'pagi';

                fetch(
                    `index.php?page=kapasitas&tanggal=${this.tanggal}&sesi=${sesi}`
                )
                .then(res => res.json())

                .then(data => {
                    this.kapasitas = data;
                })

                .catch(() => {
                    this.kapasitas = null;
                    this.reviewLoading=false;
                });

            },

            async submitReview(){

                this.reviewErrors = {
                    nama:'',
                    komentar:'',
                    rating:''
                };

                let hasError=false;


                if(!this.form.nama.trim()){
                    this.reviewErrors.nama='Nama wajib diisi';
                    hasError=true;
                }


                if(!this.form.komentar.trim()){
                    this.reviewErrors.komentar='Pengalaman wajib diisi';
                    hasError=true;
                }


                if(this.rating===0){
                    this.reviewErrors.rating='Pilih rating';
                    hasError=true;
                }


                if(hasError){
                    return;
                }


                this.reviewLoading=true;
                try{

                    let fd=new FormData();

                    fd.append('nama',this.form.nama);
                    fd.append('komentar',this.form.komentar);
                    fd.append('rating',this.rating);
                    fd.append('sesi',this.form.sesi);

                    if(this.form.gambar){
                        fd.append(
                            'gambar',
                            this.form.gambar
                        );
                    }

                    const res = await fetch(
                        'index.php?page=tambahReview',
                        {
                        method:'POST',
                        body:fd
                        });

                        const json = await res.json();

                        if(!json.success){
                        throw new Error(json.error);
                        }
                    


                    this.reviews.unshift({
                        id:Date.now(),
                        nama:this.form.nama,
                        komentar:this.form.komentar,
                        rating:this.rating,
                        sesi:this.form.sesi,
                        gambar:this.form.gambar
                            ? URL.createObjectURL(this.form.gambar)
                            : null,
                        created_at:new Date().toLocaleString()
                    });


                    this.showReviewToast=true;
                    this.showReviewModal=false;


                    this.form.nama='';
                    this.form.komentar='';
                    this.form.sesi='Pagi';
                    this.form.gambar=null;
                    this.rating=0;

                this.reviewLoading=false;
                }catch(e){
                    this.reviewLoading=false;

                    Swal.fire({
                        icon:'error',
                        title:'Review gagal',
                        text:'Tidak dapat mengirim review'
                    });

                }

            },

            submitBooking(event){

                if(this.bookingLoading) return;

                const formEl = event.target;

                const nama = formEl.nama.value.trim();
                const noWa = formEl.no_wa.value.trim();
                const tanggal = formEl.tanggal.value.trim();
                const jumlah = formEl.jumlah.value.trim();

                if(!nama){
                    Swal.fire({
                        icon:'warning',
                        title:'Nama kosong',
                        text:'Isi nama lengkap terlebih dahulu'
                    });
                    return;
                }

                if(!noWa){
                    Swal.fire({
                        icon:'warning',
                        title:'Nomor kosong',
                        text:'Isi nomor WhatsApp terlebih dahulu'
                    });
                    return;
                }

                if(!tanggal){
                    Swal.fire({
                        icon:'warning',
                        title:'Tanggal kosong',
                        text:'Pilih tanggal kunjungan'
                    });
                    return;
                }

                if(!jumlah || parseInt(jumlah) < 1){
                    Swal.fire({
                        icon:'warning',
                        title:'Jumlah tidak valid',
                        text:'Isi jumlah orang minimal 1'
                    });
                    return;
                }


                Swal.fire({
                    title:'Konfirmasi Pendaftaran',
                    text:'Apakah data booking sudah benar?',
                    icon:'question',
                    showCancelButton:true,
                    confirmButtonText:'Ya, Lanjutkan',
                    cancelButtonText:'Batal'
                })

                .then((result)=>{

                    if(!result.isConfirmed){
                        return;
                    }

                    this.bookingLoading=true;

                    const formData = new FormData(formEl);

                    fetch('index.php?page=proses_booking',{
                        method:'POST',
                        body:formData
                    })

                    .then(res=>res.json())

                    .then(res=>{

                        this.bookingLoading=false;

                        if(res.status==='error'){

                            Swal.fire({
                                icon:'error',
                                title:'Booking Gagal',
                                text:res.message
                            });

                            return;
                        }

                        if(res.status==='success'){

                            Swal.fire({
                                icon:'success',
                                title:'Booking Berhasil',
                                text:'Mengalihkan ke WhatsApp...',
                                showConfirmButton:false,
                                timer:1800
                            });

                            setTimeout(()=>{
                                window.location.href=res.url;
                            },1800);

                        }

                    })

                    .catch(()=>{

                        this.bookingLoading=false;

                        Swal.fire({
                            icon:'error',
                            title:'Server Error',
                            text:'Terjadi kesalahan sistem'
                        });

                    });

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