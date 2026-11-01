# Roda Care — Praktikum BAB 2 CSS

## Isi project
- `index.html`: halaman beranda layanan Roda Care
- `login.html`: login pengguna
- `register.html`: pendaftaran pengguna demo
- `dashboard.html`: dashboard pengguna dengan CRUD Data Kendaraan dan Data Servis
- `admin-login.html`: halaman login admin
- `admin-dashboard.html`: dashboard admin untuk melihat data pengguna, kendaraan, dan servis
- `css/style.css`: styling dan media query responsif
- `js/app.js`: validasi register/login pengguna dan login admin
- `js/crud.js`: fitur CRUD dengan localStorage
- `js/admin.js`: ringkasan data pada dashboard admin
- `assets/logo-mobil.jpeg`: gambar logo mobil

## Menjalankan
1. Ekstrak folder project dan buka di VS Code.
2. Jalankan `index.html` dengan Live Server.
3. Daftarkan pengguna melalui menu Daftar, lalu masuk melalui halaman Login.
4. Untuk login admin, buka tautan **Masuk Admin** pada halaman login atau buka `admin-login.html`.

## Akun demo admin
- Email: `admin@rodacare.id`
- Kata sandi: `Admin123`

## Catatan penting
Project ini adalah prototype praktikum yang menyimpan data di localStorage browser. Data tidak tersinkronisasi antarperangkat. Login admin berbasis JavaScript dan tidak aman untuk penggunaan produksi; aplikasi nyata perlu backend, database, penyimpanan kata sandi yang aman, dan pemeriksaan role di server.

## Commit Git yang disarankan
`BAB 2 CSS: Tambah dashboard admin dan role pengguna Roda Care`


Pembaruan logo: project ini menggunakan kembali logo lama berupa ikon roda gigi (⚙) dengan warna biru, bukan gambar mobil BMW. Versi ini mencakup halaman login Admin dan dashboard Admin.


## BAB III - JavaScript DOM dan Toast/Snackbar

Landing page `index.html` sudah diperbarui dengan manipulasi DOM menggunakan JavaScript murni pada `js/dom.js`. Implementasi yang tersedia:

1. Menu navigasi mobile dibuka/tutup dengan `classList.toggle()` dan atribut `aria-expanded`.
2. Tombol tema mengubah tema terang/gelap dengan manipulasi class pada elemen `body`.
3. Kolom pencarian menyaring kartu layanan secara langsung.
4. Tahun pada footer diubah otomatis berdasarkan tahun saat halaman dibuka.
5. Toast/Snackbar menampilkan pesan tanpa framework saat halaman dibuka dan ketika pengguna melakukan tindakan.

### Cara menguji
1. Buka `index.html` menggunakan Live Server.
2. Amati notifikasi selamat datang di kanan bawah.
3. Klik ikon bulan/matahari untuk mengubah tema.
4. Ketik kata seperti `oli` atau `ban` pada kolom Cari Layanan.
5. Pada layar kecil, klik tombol menu untuk membuka/menutup navigasi.

Tidak menggunakan framework JavaScript.
