const { createApp } = Vue;

createApp({

    data() {
        return {
            nama: '',
            email: '',
            no_wa: '',
            jumlah: 1,
            sesi: 'Pagi',
            tanggal: "<?= $pengunjung['tanggal_kunjungan'] ?? '' ?>",
            status: '',

            showErrorPopup: false,
            showSidebar: true,

            howSidebar: false,
            isDesktop: window.innerWidth > 768,

            // DATA PENGUNJUNG
            dataPengunjung: window.pengunjungData || [],
            search: '',
            filterSesi: '',
            filterStatus: '',

            // GALERI
            preview: null,
            previewEditImage: null,
            previewImageFull: null,

            editData: {
                id: null,
                judul: '',
                deskripsi: '',
                gambar: '',
                editPreview: null,

                nama: '',
                email: '',
                no_wa: '',
                jumlah: 1,
                sesi: 'Pagi',
                status: 'Tunggu',

                filterTanggal: window.selectedTanggal || '',
                showAll: false,


            }
        }
    },

    mounted() {
        console.log("ADMIN APP JALAN");

        if (window.initialData) {
            Object.assign(this.$data, window.initialData);
        }

        const urlParams = new URLSearchParams(window.location.search);

        const success = urlParams.get('success');
        const error = urlParams.get('error');

        if (success) {

            let message = '';

            // ================= LOGIN =================
            if (success === 'login') {

                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil!',
                    text: 'Selamat datang di dashboard',
                    timer: 1500,
                    showConfirmButton: false
                });

            // ================= LOGOUT =================
            } else if (success === 'logout') {

                Swal.fire({
                    icon: 'success',
                    title: 'Logout Berhasil',
                    text: 'Anda telah keluar dari sistem',
                    timer: 1500,
                    showConfirmButton: false
                });

            } else {

                // ================= GALERI =================
                if (success === 'tambah') {
                    message = 'Galeri berhasil ditambahkan';
                } else if (success === 'update') {
                    message = 'Galeri berhasil diperbarui';
                } else if (success === 'hapus') {
                    message = 'Galeri berhasil dihapus';
                }

                // ================= PENGUNJUNG =================
                else if (success === 'tambah_pengunjung') {
                    message = 'Pengunjung berhasil ditambahkan';
                } else if (success === 'update_pengunjung') {
                    message = 'Data pengunjung berhasil diperbarui';
                } else if (success === 'hapus_pengunjung') {
                    message = 'Pengunjung berhasil dihapus';
                }

                if (message) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }

            // bersihin URL biar gak ke-trigger lagi
            window.history.replaceState({}, document.title, window.location.pathname);
        }

        // ================= ERROR =================
        if (error) {

            let message = 'Terjadi kesalahan';

            if (error === 'login') {
                message = 'Username atau password salah';
            }

            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: message,
            });

            window.history.replaceState({}, document.title, window.location.pathname);
        }

            window.addEventListener('resize', () => {
                this.isDesktop = window.innerWidth > 768;
            });
    },
    
    computed: {

        avatar() {
            if (!this.nama) {
                return "https://ui-avatars.com/api/?name=User";
            }
            return "https://ui-avatars.com/api/?name=" + this.nama;
        },


        filteredData() {
            if (!this.dataPengunjung) return [];

            return this.dataPengunjung.filter(p => {

                const matchSearch =
                    p.nama.toLowerCase().includes(this.search.toLowerCase()) ||
                    p.id.toString().includes(this.search);

                const matchSesi =
                    !this.filterSesi || p.sesi === this.filterSesi;

                const matchStatus =
                    !this.filterStatus || p.status === this.filterStatus;

                return matchSearch && matchSesi && matchStatus;
            });
        }
    },
    methods: {

        // PREVIEW UPLOAD
        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                this.preview = URL.createObjectURL(file);
            }
        },

        // PREVIEW FULL IMAGE
        previewFull(gambar) {
            this.previewImageFull = gambar;

            const modalEl = document.getElementById('previewModal');
            if (modalEl) {
                new bootstrap.Modal(modalEl).show();
            }
        },

        // EDIT MODAL (FIXED)
        openEditFromElement(event) {
            const el = event.currentTarget;

            this.editData.id = el.dataset.id;
            this.editData.judul = el.dataset.judul;
            this.editData.deskripsi = el.dataset.deskripsi;
            this.editData.gambar = el.dataset.gambar;

            this.previewEditImage = null;

            const modal = document.getElementById('editModal');
            if (modal) {
                new bootstrap.Modal(modal).show();
            }
        },

        openEditPengunjung(id, nama, email, no_wa, jumlah, sesi, status) {
            this.editData.id = id;
            this.editData.nama = nama;
            this.editData.email = email;
            this.editData.no_wa = no_wa;
            this.editData.jumlah = jumlah;
            this.editData.sesi = sesi;
            this.editData.status = status;

        },

        closePopup() {
            this.showErrorPopup = false;
        },

        toggleSidebar() {
            this.showSidebar = !this.showSidebar;
            localStorage.setItem('sidebar', this.showSidebar);
        },

        // STATUS BADGE (INI YANG ERROR TADI)
        statusClass(status) {
            if (status === 'Menunggu Pembayaran') return 'bg-warning text-dark';
            if (status === 'Dibayar') return 'bg-success';
            if (status === 'Selesai') return 'bg-primary';
            if (status === 'Dibatalkan') return 'bg-danger';
            return 'bg-secondary';
        },

        // COUNTER
        animateCounter() {
            document.querySelectorAll('.counter').forEach(el => {
                let target = +el.getAttribute('data-target');
                let count = 0;

                let update = () => {
                    let increment = target / 40;

                    if (count < target) {
                        count += increment;
                        el.innerText = Math.floor(count);
                        requestAnimationFrame(update);
                    } else {
                        el.innerText = target;
                    }
                };

                update();
            });
        },

        // DELETE POPUP
        confirmDelete(url) {
            Swal.fire({
                title: 'Yakin hapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

    }

}).mount('#app');