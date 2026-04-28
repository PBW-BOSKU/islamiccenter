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

<img width="1919" height="943" alt="Screenshot 2026-04-28 230153" src="https://github.com/user-attachments/assets/47c5ebbb-d169-443f-abfc-c67f932843e1" />

##### Halaman ini merupakan tampilan awal yang diakses oleh pengguna. Terdapat elemen hero section berupa gambar Menara Islamic Center Samarinda yang dipadukan dengan judul utama dan deskripsi singkat sebagai pengantar informasi. Navigasi utama ditempatkan di bagian atas untuk memudahkan akses ke halaman lain seperti galeri, filosofi, fasilitas, review, dan lokasi. Tersedia tombol aksi “Pesan Tiket” yang mengarahkan pengguna ke halaman booking.
#

#### B. Halaman Galeri

<img width="1919" height="623" alt="Screenshot 2026-04-28 231017" src="https://github.com/user-attachments/assets/2c127695-5d35-4344-b9d2-a14bc8a651e9" />

##### Halaman ini menampilkan kumpulan dokumentasi visual dalam bentuk grid layout. Setiap gambar merepresentasikan fasilitas dan sudut bangunan Islamic Center. Struktur tampilan dirancang responsif sehingga gambar tersusun rapi dan mudah dipahami oleh pengguna.
#

#### C. Tampilan Detail Galeri

<img width="1919" height="943" alt="Screenshot 2026-04-28 231024" src="https://github.com/user-attachments/assets/f019e827-960c-4a6d-9558-83d37822907f" />

##### Ketika pengguna memilih salah satu gambar, sistem menampilkan detail gambar dalam bentuk modal popup. Fitur ini memungkinkan pengguna melihat gambar dalam ukuran lebih besar tanpa berpindah halaman. Disertai dengan deskripsi singkat untuk memberikan konteks informasi.
#

#### D. Halaman Filosofi

<img width="1919" height="837" alt="Screenshot 2026-04-28 231107" src="https://github.com/user-attachments/assets/b768cf3a-491c-428d-a36a-9ea94d9a54c1" />


##### Halaman ini berisi penjelasan konseptual terkait nilai dan makna arsitektur Islamic Center. Informasi disajikan dalam bentuk kombinasi teks dan gambar untuk meningkatkan pemahaman pengguna. Setiap bagian menjelaskan elemen simbolik seperti menara, ornamen, dan struktur bangunan.
#

#### E. Halaman Fasilitas

<img width="1919" height="949" alt="Screenshot 2026-04-28 231144" src="https://github.com/user-attachments/assets/3862783d-1ce2-4f02-b261-d14e3b14878f" />

##### Halaman ini menampilkan informasi fasilitas yang tersedia, seperti area parkir, lift, dan area publik lainnya. Informasi disusun dalam bentuk card layout yang dilengkapi gambar dan deskripsi singkat untuk setiap fasilitas.
#

#### F. Halaman Detail Fasilitas
<img width="1919" height="947" alt="Screenshot 2026-04-28 231153" src="https://github.com/user-attachments/assets/a24ed2f8-fece-4c62-b05d-d1dd153c823a" />

##### Halaman ini menyediakan fitur pop-up interaktif yang menampilkan detail lebih lanjut dari setiap fasilitas. Informasi disajikan dalam bentuk galeri visual yang memuat kumpulan gambar untuk memberikan gambaran area secara lebih menyeluruh.
#

#### G. Halaman Review Pengunjung

<img width="1919" height="947" alt="Screenshot 2026-04-28 231153" src="https://github.com/user-attachments/assets/7b940461-3e08-4de1-8a35-bc0b18f43d4c" />

##### Halaman ini menyediakan fitur interaksi berupa penilaian dan ulasan dari pengunjung. Pengguna dapat memberikan rating serta menuliskan pengalaman mereka. Selain itu, sistem juga menampilkan rata-rata penilaian yang dihitung dari data yang tersimpan.
#

#### H. Halaman Lokasi

<img width="1919" height="889" alt="Screenshot 2026-04-28 231407" src="https://github.com/user-attachments/assets/edfb24d6-e423-4bdd-ad70-1f5b7301ce56" />

##### Halaman ini menampilkan peta lokasi Islamic Center Samarinda yang terintegrasi dengan Google Maps. Pengguna dapat melihat posisi lokasi secara langsung dan mengakses navigasi melalui tombol yang tersedia.
#

#### I. Halaman Booking (Form Pendaftaran)
<img width="1253" height="614" alt="image" src="https://github.com/user-attachments/assets/7377aa98-f8cf-4649-9949-cdccb127622a" />

##### Halaman ini digunakan oleh pengguna untuk melakukan pendaftaran kunjungan. Formulir mencakup input data seperti nama, email, nomor telepon, tanggal kunjungan, jumlah pengunjung, dan sesi kunjungan. Terdapat validasi input untuk memastikan data yang dimasukkan sesuai.
#

#### J. Halaman Login Admin

<img width="1919" height="942" alt="Screenshot 2026-04-28 233456" src="https://github.com/user-attachments/assets/c229f494-8abf-40fe-bfa6-289028b8bc81" />

##### Halaman ini digunakan oleh admin untuk mengakses sistem backend. Terdapat validasi autentikasi berupa username dan password. Sistem akan menampilkan notifikasi apabila terjadi kesalahan input.
#

#### K. Halaman Dashboard Admin

<img width="1919" height="943" alt="Screenshot 2026-04-28 233540" src="https://github.com/user-attachments/assets/554de588-abf0-44bf-9b9c-37c183cbb2fa" />

##### Halaman ini menampilkan ringkasan data dalam bentuk statistik, seperti jumlah pengunjung, jumlah pendaftar, dan kapasitas kunjungan. Terdapat juga informasi aktivitas terbaru yang membantu admin dalam monitoring sistem.
#

#### L. Slidebar Navigasi Admin

<img width="1919" height="942" alt="Screenshot 2026-04-28 233612" src="https://github.com/user-attachments/assets/b00ac7b1-292f-49d8-9dc3-23daf089c8cb" />

##### Sidebar berfungsi sebagai navigasi utama pada halaman admin. Menu yang tersedia meliputi dashboard, data pengunjung, dan galeri. Struktur ini memudahkan admin dalam mengakses fitur pengeloalaan.
#

#### M. Halaman Data Pengunjung

<img width="1919" height="944" alt="Screenshot 2026-04-29 000646" src="https://github.com/user-attachments/assets/e905e5f4-fbb2-418e-bfdf-90c89e2a01c9" />

##### Halaman ini menampilkan tabel data pengunjung yang diambil dari database. Terdapat fitur pencarian, filter berdasarkan sesi, serta aksi untuk mengedit dan menghapus data, serta mengirimkan tiket bagi yang sudah melakukan pembayaran via WhatsApp Informasi ditampilkan secara terstruktur untuk memudahkan pengelolaan.
#

#### N. Halaman Edit Data Pengunjung

<img width="1919" height="942" alt="Screenshot 2026-04-29 000902" src="https://github.com/user-attachments/assets/baaf93b5-54ab-4075-bea3-5faad13ef046" />

##### Halaman ini digunakan untuk memperbarui data pengunjung. Form yang tersedia menampilkan data sebelumnya sehingga admin dapat melakukan perubahan dengan lebih mudah dan akurat.
#

#### O. Halaman Tambah Data Pengunjung

<img width="1919" height="942" alt="Screenshot 2026-04-29 001017" src="https://github.com/user-attachments/assets/2280623b-c973-4066-89a2-2a94f39d5679" />


##### Halaman ini menyediakan form input untuk menambahkan data pengunjung baru. Sistem juga menampilkan preview data sebelum disimpan untuk mengurangi kesalahan input.
#

#### P. Konfirmasi Hapus Data

<img width="1919" height="938" alt="Screenshot 2026-04-29 001036" src="https://github.com/user-attachments/assets/ed9d6178-fabc-4a00-a039-5f28623e4639" />

##### Sistem menampilkan dialog konfirmasi sebelum data dihapus. Fitur ini bertujuan untuk mencegah kesalahan penghapusan data yang bersifat permanen.
#

#### Q. Fitur Pencarian Data Pengunjung

<img width="1117" height="281" alt="Screenshot 2026-04-29 001101" src="https://github.com/user-attachments/assets/d764dfe2-9e8e-44b9-b42f-c2e0531e7b29" />

##### Fitur ini memungkinkan admin mencari data secara cepat berdasarkan nama atau ID booking. Hasil pencarian ditampilkan secara real-time.
#

#### R. Halaman Galeri Admin (Upload Gambar)

<img width="1919" height="938" alt="Screenshot 2026-04-29 005431" src="https://github.com/user-attachments/assets/673c9190-248b-4cd3-994a-9783a0dcf026" />


##### Halaman ini digunakan untuk menambahkan data galeri baru. Admin dapat mengunggah gambar, memberikan judul, dan deskripsi sebelum dipublikasikan.
#

#### S. Preview Upload Gambar

<img width="1777" height="541" alt="Screenshot 2026-04-29 005348" src="https://github.com/user-attachments/assets/e8668672-accc-4565-9d7a-3af34fd396eb" />

##### Sistem menampilkan preview gambar sebelum dipublikasikan. Hal ini membantu admin memastikan file yang diunggah sudah sesuai.
#

#### T. Halaman Edit Galeri (Modal)

<img width="1919" height="946" alt="Screenshot 2026-04-29 005234" src="https://github.com/user-attachments/assets/c2f8a8a9-489e-4f0f-b903-03a56b41df64" />

##### Admin dapat mengedit data galeri melalui tampilan modal. Perubahan dapat dilakukan pada judul, deskripsi, maupun gambar.
#
