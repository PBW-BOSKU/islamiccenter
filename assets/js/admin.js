const { createApp } = Vue;

createApp({

data() {
return {

nama: '',
no_wa: '',
jumlah: 1,
sesi: 'Pagi',
tanggal: '',
status: '',

showErrorPopup: false,
showSidebar: true,
isDesktop: window.innerWidth > 768,

/* DATA PENGUNJUNG */
dataPengunjung: window.pengunjungData || [],

search: '',
filterSesi: '',
filterStatus: '',

dragOver:false,

/* GALERI */
preview: null,
editPreview: null,
previewImageFull: null,

selectedTitle: '',
selectedDesc: '',

editData: {
id: null,
judul: '',
deskripsi: '',
gambar: '',
editPreview: null,

nama: '',
no_wa: '',
jumlah: 1,
tanggal: '',
sesi: 'Pagi',
status: 'Menunggu Pembayaran'
}

}
},

mounted() {

console.log("ADMIN APP JALAN");
console.log("DATA LOADED:", this.dataPengunjung);


/* INITIAL DATA */
if(window.initialData){
Object.assign(
this.$data,
window.initialData
);
}


/* SUCCESS / ERROR ALERT */
const urlParams =
new URLSearchParams(
window.location.search
);

const success =
urlParams.get('success');

const error =
urlParams.get('error');


if(success){

let message='';

if(success==='login'){

Swal.fire({
icon:'success',
title:'Login Berhasil',
text:'Selamat datang',
timer:1500,
showConfirmButton:false
});

}

else if(success==='logout'){

Swal.fire({
icon:'success',
title:'Logout Berhasil',
timer:1500,
showConfirmButton:false
});

}

else{

if(success==='tambah'){
message='Galeri berhasil ditambahkan';
}

else if(success==='update'){
message='Galeri berhasil diperbarui';
}

else if(success==='hapus'){
message='Galeri berhasil dihapus';
}

else if(success==='tambah_pengunjung'){
message='Pengunjung berhasil ditambahkan';
}

else if(success==='update_pengunjung'){
message='Data pengunjung diperbarui';
}

else if(success==='hapus_pengunjung'){
message='Pengunjung dihapus';
}

else if(success==='hapus_review'){
message='Review dihapus';
}

if(message){

Swal.fire({
icon:'success',
title:'Berhasil',
text:message,
timer:2000,
showConfirmButton:false
});

}

}

window.history.replaceState(
{},
document.title,
window.location.pathname
);

}


if(error){

Swal.fire({
icon:'error',
title:'Gagal',
text:'Terjadi kesalahan'
});

window.history.replaceState(
{},
document.title,
window.location.pathname
);

}


/* RESPONSIVE */
window.addEventListener(
'resize',
()=>{
this.isDesktop =
window.innerWidth > 768;
}
);

},


computed: {

avatar(){

if(!this.nama){
return "https://ui-avatars.com/api/?name=User";
}

return (
"https://ui-avatars.com/api/?name=" +
this.nama
);

},


filteredData(){

if(
!Array.isArray(
this.dataPengunjung
)
){
return [];
}

return this.dataPengunjung.filter(p=>{

const keyword = this.search.toLowerCase();

const matchSearch = !keyword || [

p.nama,
p.kode_booking,
p.no_wa,
p.status,
p.sesi

].some(v =>
String(v || '')
.toLowerCase()
.includes(keyword)
);


const matchSesi =

!this.filterSesi ||

(
(p.sesi || '')
.toLowerCase()

===

this.filterSesi
.toLowerCase()
);


const matchStatus =

!this.filterStatus ||

(
p.status || ''
) === this.filterStatus;


return (
matchSearch &&
matchSesi &&
matchStatus
);

});

}

},


methods: {

countWords(text){

if(!text) return 0;

return text
.trim()
.split(/\s+/)
.filter(Boolean)
.length;

},


previewImage(event){

const file =
event.target.files[0];

if(file){

this.preview =
URL.createObjectURL(
file
);

}

},

previewEditImage(event){

const file = event.target.files[0];

if(file){
this.editPreview =
URL.createObjectURL(file);
}

},


previewFull(gambar,judul,deskripsi){

this.previewImageFull = gambar;

this.selectedTitle = judul;

this.selectedDesc = deskripsi;


const modal =
document.getElementById('previewModal');

if(modal){
new bootstrap.Modal(modal).show();
}

},


openEditFromElement(event){

const el =
event.currentTarget;

this.editData.id =
el.dataset.id;

this.editData.judul =
el.dataset.judul;

this.editData.deskripsi =
el.dataset.deskripsi;

this.editData.gambar =
el.dataset.gambar;

this.editPreview =
null;

const modal =
document.getElementById(
'editModal'
);

if(modal){

new bootstrap.Modal(
modal
).show();

}

},


openEditPengunjung(
id,
nama,
no_wa,
jumlah,
sesi,
status
){

this.editData.id=id;
this.editData.nama=nama;
this.editData.no_wa=no_wa;
this.editData.jumlah=jumlah;
this.editData.sesi=sesi || 'Pagi';
this.editData.status=status;

},


closePopup(){

this.showErrorPopup=false;

},


toggleSidebar(){

this.showSidebar=
!this.showSidebar;

localStorage.setItem(
'sidebar',
this.showSidebar
);

},


statusClass(status){

if(
status==='Menunggu Pembayaran'
){
return 'bg-warning text-dark';
}

if(
status==='Dibayar'
){
return 'bg-success';
}

if(
status==='Selesai'
){
return 'bg-primary';
}

if(
status==='Dibatalkan'
){
return 'bg-danger';
}

return 'bg-secondary';

},


confirmDelete(url){

Swal.fire({

title:'Yakin hapus?',
text:'Data tidak bisa dikembalikan',
icon:'warning',

showCancelButton:true,

confirmButtonColor:'#dc3545',
cancelButtonColor:'#6c757d',

confirmButtonText:'Ya hapus',
cancelButtonText:'Batal',

reverseButtons:true

}).then(result=>{

if(
result.isConfirmed
){
window.location.href=url;
}

});
},

handleDrop(event){

this.dragOver=false;

const files =
event.dataTransfer.files;

if(!files.length) return;

const file = files[0];

const allowed = [
'image/jpeg',
'image/png',
'image/webp'
];

if(
!allowed.includes(file.type)
){
Swal.fire(
'File tidak valid',
'Gunakan jpg/png/webp',
'error'
);
return;
}

if(
file.size >
2 * 1024 * 1024
){
Swal.fire(
'Terlalu besar',
'Maksimal 2MB',
'error'
);
return;
}


/* inject file ke input */
const dt =
new DataTransfer();

dt.items.add(file);

this.$refs.file.files =
dt.files;


/* preview */
this.preview =
URL.createObjectURL(file);

}

}

}).mount('#app');