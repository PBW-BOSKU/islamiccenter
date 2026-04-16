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

            // DATA PENGUNJUNG
            pengunjung: window.pengunjungData || [],
            search: '',
            filterSesi: '',

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
            }
        }
    },

    mounted() {
        console.log("ADMIN APP JALAN");

        if (window.initialData) {
            Object.assign(this.$data, window.initialData);
        }

        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.get('error')) {
            this.showErrorPopup = true;
        }

        if (document.querySelector('.counter')) {
            this.animateCounter();
        }

        if (urlParams.get('updated')) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Galeri berhasil diperbarui',
                timer: 2000,
                showConfirmButton: false
            });
        }
    },

    computed: {

        avatar() {
            if (!this.nama) {
                return "https://ui-avatars.com/api/?name=User";
            }
            return "https://ui-avatars.com/api/?name=" + this.nama;
        },

        filteredData() {
            return this.pengunjung.filter(p => {

                let matchSearch =
                    p.nama.toLowerCase().includes(this.search.toLowerCase()) ||
                    p.id.toString().includes(this.search);

                let matchSesi =
                    this.filterSesi === '' || p.sesi === this.filterSesi;

                return matchSearch && matchSesi;
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
            if (status === 'Check-in') return 'bg-success';
            if (status === 'Tunggu') return 'bg-warning text-dark';
            if (status === 'Dibatalkan') return 'bg-danger';
            return 'bg-info';
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

}).mount('#appTable');