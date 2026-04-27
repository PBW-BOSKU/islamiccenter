# PROJEK AKHIR PEMROGRAMAN BERBASIS WEB 
### PORTAL INFORMASI & PANDUAN WISATA ISLAMIC CENTER SAMARINDA

#### Kelompok  : 4B
#### Nama Tim  : ADAKAH
#

### Deskripsi Website
Website yang dibuat merupakan sebuah sistem informasi berbasis web yang berfokus pada Menara Islamic Center Samarinda sebagai objek wisata religi. Website ini bertujuan untuk memberikan informasi terkait menara, fasilitas pendukung, galeri, serta layanan kunjungan, sekaligus membantu pengelola dalam melakukan pendataan pengunjung dan pengelolaan konten secara digital.

Website ini memiliki dua jenis pengguna, yaitu admin dan pengunjung. Pengunjung dapat mengakses informasi mengenari menara, melihat galeri, membaca ulasan, melihat lokasi, serta melakukan pendaftaran kunjungan melalui fitur booking. Sementara itu, admin dapat mengelola data pengunjung, galeri, serta konten website melalui dashboard yang telah disediakan.

Fitur utama yang tersedia dalam webste ini meliputi halaman beranda, galeri, filosofi, fasilitas, review pengunjung, lokasi, serta halaman booking untuk pendataan kunjungan. Pada sisi admin, tersedia fitur pengelolaan data pengunjung dan galeri sistem CRUD.

Website ini dibangun menggunakan bahasa pemrograman PHP Native dengan struktur berbasis konsep MVC (Model-View-Controller) serta menggunakan database MySQL untuk penyimpanan data.
#

### Fitur Website

#### A. Halaman Beranda
<img width="1380" height="682" alt="image" src="https://github.com/user-attachments/assets/53e567cc-539b-497d-8f5b-f17b8a59542c" />

##### Halaman ini merupakan tampilan awal yang diakses oleh pengguna. Terdapat elemen hero section berupa gambar Menara Islamic Center Samarinda yang dipadukan dengan judul utama dan deskripsi singkat sebagai pengantar informasi. Navigasi utama ditempatkan di bagian atas untuk memudahkan akses ke halaman lain seperti galeri, filosofi, fasilitas, review, dan lokasi. Tersedia tombol aksi “Pesan Tiket” yang mengarahkan pengguna ke halaman booking.
#

#### B. Halaman Galeri
<img width="1380" height="320" alt="image" src="https://github.com/user-attachments/assets/12653672-42ca-4419-a696-a725640492c6" />

##### Halaman ini menampilkan kumpulan dokumentasi visual dalam bentuk grid layout. Setiap gambar merepresentasikan fasilitas dan sudut bangunan Islamic Center. Struktur tampilan dirancang responsif sehingga gambar tersusun rapi dan mudah dipahami oleh pengguna.
#

#### C. Tampilan Detail Galeri
<img width="1380" height="684" alt="image" src="https://github.com/user-attachments/assets/e790e995-9163-4c1d-9b18-c01258e4bd2b" />

##### Ketika pengguna memilih salah satu gambar, sistem menampilkan detail gambar dalam bentuk modal popup. Fitur ini memungkinkan pengguna melihat gambar dalam ukuran lebih besar tanpa berpindah halaman. Disertai dengan deskripsi singkat untuk memberikan konteks informasi.
#

#### D. Halaman Filosofi
<img width="1380" height="531" alt="image" src="https://github.com/user-attachments/assets/123e67be-a858-45d0-beaa-c5a969958b54" />

##### Halaman ini berisi penjelasan konseptual terkait nilai dan makna arsitektur Islamic Center. Informasi disajikan dalam bentuk kombinasi teks dan gambar untuk meningkatkan pemahaman pengguna. Setiap bagian menjelaskan elemen simbolik seperti menara, ornamen, dan struktur bangunan.
#

#### E. Halaman Fasilitas
<img width="1380" height="680" alt="image" src="https://github.com/user-attachments/assets/58ad9692-8795-41f3-ab4e-cb2670f78605" />

##### Halaman ini menampilkan informasi fasilitas yang tersedia, seperti area parkir, lift, dan area publik lainnya. Informasi disusun dalam bentuk card layout yang dilengkapi gambar dan deskripsi singkat untuk setiap fasilitas.
#

#### F. Halaman Review Pengunjung
<img width="1380" height="679" alt="image" src="https://github.com/user-attachments/assets/1cab85f0-628c-4f3c-a880-dd69c5037cd4" />

##### Halaman ini menyediakan fitur interaksi berupa penilaian dan ulasan dari pengunjung. Pengguna dapat memberikan rating serta menuliskan pengalaman mereka. Selain itu, sistem juga menampilkan rata-rata penilaian yang dihitung dari data yang tersimpan.
#

#### G. Halaman Lokasi
<img width="1380" height="536" alt="image" src="https://github.com/user-attachments/assets/6b191808-0a23-42a1-85a9-b756487b0d79" />

##### Halaman ini menampilkan peta lokasi Islamic Center Samarinda yang terintegrasi dengan Google Maps. Pengguna dapat melihat posisi lokasi secara langsung dan mengakses navigasi melalui tombol yang tersedia.
#

#### H. Halaman Booking (Form Pendaftaran)
<img width="1253" height="614" alt="image" src="https://github.com/user-attachments/assets/7377aa98-f8cf-4649-9949-cdccb127622a" />

##### Halaman ini digunakan oleh pengguna untuk melakukan pendaftaran kunjungan. Formulir mencakup input data seperti nama, email, nomor telepon, tanggal kunjungan, jumlah pengunjung, dan sesi kunjungan. Terdapat validasi input untuk memastikan data yang dimasukkan sesuai.
#

#### I. Halaman Login Admin
<img width="1378" height="679" alt="image" src="https://github.com/user-attachments/assets/1714b344-89e7-4bf6-ba76-7d364cc8f943" />

##### Halaman ini digunakan oleh admin untuk mengakses sistem backend. Terdapat validasi autentikasi berupa username dan password. Sistem akan menampilkan notifikasi apabila terjadi kesalahan input.
#

#### J. Halaman Login Admin (Gagal)
<img width="940" height="465" alt="image" src="https://github.com/user-attachments/assets/38346774-51ed-4ad6-a329-1a750807ef1d" />

##### Ketika terjadi kesalahan autentikasi, sistem menampilkan notifikasi berupa pesan kesalahan secara langsung pada halaman. Bertujuan untuk memberikan umpan balik yang cepat kepada pengguna.
#

#### K. Halaman Dashboard Admin
<img width="1380" height="678" alt="image" src="https://github.com/user-attachments/assets/4d346b51-3da0-4231-99a6-f74c2b623c54" />

##### Halaman ini menampilkan ringkasan data dalam bentuk statistik, seperti jumlah pengunjung, jumlah pendaftar, dan kapasitas kunjungan. Terdapat juga informasi aktivitas terbaru yang membantu admin dalam monitoring sistem.
#

#### I. Slidebar Navigasi Admin
<img width="1380" height="678" alt="image" src="https://github.com/user-attachments/assets/6b818508-d814-4bf1-9dc9-569c78b421ec" />

##### Sidebar berfungsi sebagai navigasi utama pada halaman admin. Menu yang tersedia meliputi dashboard, data pengunjung, dan galeri. Struktur ini memudahkan admin dalam mengakses fitur pengeloalaan.
#

#### M. Halaman Data Pengunjung
<img width="1380" height="682" alt="image" src="https://github.com/user-attachments/assets/8e4989c2-a49a-4929-b390-5bf0d5b00f19" />

##### Halaman ini menampilkan tabel data pengunjung yang diambil dari database. Terdapat fitur pencarian, filter berdasarkan sesi, serta aksi untuk mengedit dan menghapus data, serta mengirimkan tiket bagi yang sudah melakukan pembayaran via WhatsApp Informasi ditampilkan secara terstruktur untuk memudahkan pengelolaan.
#

#### N. Halaman Edit Data Pengunjung
<img width="1380" height="682" alt="image" src="https://github.com/user-attachments/assets/b37f9d4d-4468-4e61-9da5-4f8cf1330441" />

##### Halaman ini digunakan untuk memperbarui data pengunjung. Form yang tersedia menampilkan data sebelumnya sehingga admin dapat melakukan perubahan dengan lebih mudah dan akurat.
#

#### O. Halaman Tambah Data Pengunjung
<img width="1380" height="679" alt="image" src="https://github.com/user-attachments/assets/28377f98-b49e-4647-a082-e7bad0ffefe0" />

##### Halaman ini menyediakan form input untuk menambahkan data pengunjung baru. Sistem juga menampilkan preview data sebelum disimpan untuk mengurangi kesalahan input.
#

#### P. Konfirmasi Hapus Data
<img width="1380" height="676" alt="image" src="https://github.com/user-attachments/assets/40cfc79c-6e56-44be-b84c-63464c39e592" />

##### Sistem menampilkan dialog konfirmasi sebelum data dihapus. Fitur ini bertujuan untuk mencegah kesalahan penghapusan data yang bersifat permanen.
#

#### Q. Fitur Pencarian Data Pengunjung
<img width="1222" height="326" alt="image" src="https://github.com/user-attachments/assets/a941d1a6-ee9c-418e-add6-27c4c0f1ab70" />

##### Fitur ini memungkinkan admin mencari data secara cepat berdasarkan nama atau ID booking. Hasil pencarian ditampilkan secara real-time.
#

#### R. Halaman Galeri Admin (Upload Gambar)
<img width="1380" height="682" alt="image" src="https://github.com/user-attachments/assets/ac2fea48-c045-4ce2-b829-433f95083910" />

##### Halaman ini digunakan untuk menambahkan data galeri baru. Admin dapat mengunggah gambar, memberikan judul, dan deskripsi sebelum dipublikasikan.
#

#### S. Preview Upload Gambar
<img width="1379" height="346" alt="image" src="https://github.com/user-attachments/assets/ab2db396-d57c-4464-8f41-5e69dfed07aa" />

##### Sistem menampilkan preview gambar sebelum dipublikasikan. Hal ini membantu admin memastikan file yang diunggah sudah sesuai.
#

#### T. Halaman Edit Galeri (Modal)
<img width="1379" height="679" alt="image" src="https://github.com/user-attachments/assets/e8bacfed-5507-4426-b73f-43ea32599ec1" />

##### Admin dapat mengedit data galeri melalui tampilan modal. Perubahan dapat dilakukan pada judul, deskripsi, maupun gambar.
#
