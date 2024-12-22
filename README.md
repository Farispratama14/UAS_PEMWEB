# Dreamy Plushie Co 🎀

Selamat datang di repository resmi **Dreamy Plushie Co**, sebuah website modern untuk manajemen toko boneka. Website ini dirancang untuk mempermudah pengelolaan stok barang dan data karyawan dalam sebuah toko. Dengan antarmuka yang user-friendly, website ini memberikan solusi lengkap untuk operasional toko Anda.

---

## ✨ Fitur Utama
### 1. **Inventory Management**
   - **Input Data Barang**: Tambahkan nama barang dan jumlah stok dengan mudah.
   - **Barang Masuk dan Keluar**: Catat barang masuk dan keluar secara real-time untuk menjaga stok tetap akurat.
   - **Tampilan Stok**: Lihat data stok barang dengan informasi yang terorganisir.

### 2. **Employee Management**
   - **Input Data Karyawan**: Tambahkan data karyawan dengan detail berikut:
     - Nama
     - Nomor HP
     - Posisi (Position)
   - **Aksi**: Hapus data karyawan jika tidak diperlukan.
   - **Tampilan Data**: Lihat daftar karyawan yang sudah terdaftar dalam satu halaman.

### 3. **Login & Register System**
   - **Login**: Akses ke sistem dengan autentikasi aman menggunakan hashed password.
   - **Register**: Tambahkan pengguna baru ke dalam sistem dengan validasi data.

---

## 🛠️ Teknologi yang Digunakan
- **Frontend**: 
  - HTML5, CSS3 (desain responsif dengan gradient modern)
  - JavaScript untuk validasi dan interaksi pengguna
- **Backend**: 
  - PHP untuk pemrosesan logika server
- **Database**:
  - MySQL untuk menyimpan data barang, karyawan, dan pengguna

---

## 📂 Penjelasan dan Evaluasi Kode 📂 ## 

## Bagian 1: Client-side Programming (Bobot: 30%)

### 1.1 Manipulasi DOM dengan JavaScript (15%)
- **Kriteria:** Form harus memiliki validasi manual di elemen input (e.g., checkbox, text, dll).
- **Implementasi di Kode:**
  - Validasi input dilakukan pada event submit menggunakan `addEventListener` di form `#form-karyawan`.
  - Script memeriksa apakah field input (nama, no_hp, posisi) telah diisi sebelum data dapat dikirim.
  - Jika ada field kosong, akan muncul alert dan form tidak akan disubmit.
  
  **Kesimpulan:** Kriteria telah terpenuhi.

### 1.2 Event Handling (15%)
- **Kriteria:**
  - Menangani event pada form seperti submit.
  - Implementasi JavaScript untuk validasi data input sebelum diterima oleh PHP.
- **Implementasi di Kode:**
  - Event handler `submit` digunakan untuk mencegah pengiriman form jika ada field yang kosong.

  **Kesimpulan:** Kriteria telah terpenuhi.

---

## Bagian 2: Server-side Programming (Bobot: 30%)

### 2.1 Pengelolaan Data dengan PHP (20%)
- **Kriteria:** CRUD data pada tabel database.
- **Implementasi di Kode:**
  - Tabel `Employee` menampilkan data dari database.
  - Tombol `Hapus` disediakan untuk menghapus data karyawan.
  - Data baru dapat ditambahkan menggunakan form.

  **Kesimpulan:** Kriteria telah terpenuhi.

### 2.2 Objek PHP Berbasis OOP (10%)
- **Kriteria:**
  - Kelas PHP harus digunakan untuk mempermudah pengelolaan database.
  - Menggunakan metode di dalam class untuk database interaction.
- **Implementasi di Kode:**
  - Kode menggunakan class `Koneksi` untuk mengatur koneksi ke database dan menyediakan metode `getMahasiswa`.

  **Kesimpulan:** Kriteria telah terpenuhi.

---

## Bagian 3: Database Management (Bobot: 20%)

### 3.1 Pembuatan Tabel Database (5%)
- **Kriteria:** Tabel database dibuat sesuai spesifikasi dengan primary key.
- **Implementasi di Kode:**
  - SQL yang disediakan untuk membuat tabel memenuhi kriteria, termasuk kolom `id` sebagai primary key.

  **Kesimpulan:** Kriteria telah terpenuhi.

### 3.2 Konfigurasi Koneksi Database (5%)
- **Kriteria:** Koneksi ke database menggunakan file PHP terpisah.
- **Implementasi di Kode:**
  - Class `Koneksi` menangani koneksi ke database.

  **Kesimpulan:** Kriteria telah terpenuhi.

### 3.3 Manipulasi Data pada Database (10%)
- **Kriteria:** PHP harus dapat membaca dan memanipulasi data dari tabel.
- **Implementasi di Kode:**
  - Metode `getMahasiswa` di class `Koneksi` digunakan untuk membaca data dari tabel.

  **Kesimpulan:** Kriteria telah terpenuhi.

---

## Bagian 4: State Management (Bobot: 20%)

### 4.1 State Management dengan Session (10%)
- **Kriteria:** Menggunakan session_start() untuk memulai sesi.
- **Implementasi di Kode:**
  - `session_start()` digunakan untuk menyimpan jumlah page view.
  - Jumlah page view ditampilkan menggunakan `$_SESSION['count']`.

  **Kesimpulan:** Kriteria telah terpenuhi.

### 4.2 Pengelolaan State dengan Cookie dan Browser Storage (10%)
- **Kriteria:**
  - Membaca, menyimpan, dan menghapus cookie.
  - Memanfaatkan browser storage (localStorage).
- **Implementasi di Kode:**
  - Cookie dikelola menggunakan fungsi PHP `setcookie()`.
  - Local Storage digunakan untuk menyimpan jumlah page view.

  **Kesimpulan:** Kriteria telah terpenuhi.

---

## Bagian 5: Inventory Management (Tambahan Gambar 1, 2, dan 3)

### 5.1 Validasi Data Inventory
- **Kriteria:**
  - Input inventory harus divalidasi menggunakan JavaScript untuk mencegah data kosong atau tidak valid.
- **Implementasi di Kode:**
  - Form inventory telah dilengkapi validasi untuk memeriksa apakah semua field terisi dengan benar.

  **Kesimpulan:** Kriteria telah terpenuhi.

### 5.2 CRUD Data Inventory
- **Kriteria:**
  - Sistem mendukung operasi tambah, ubah, dan hapus data inventory.
- **Implementasi di Kode:**
  - Operasi CRUD untuk inventory telah diimplementasikan menggunakan PHP.
  - Data inventory dapat ditampilkan di tabel dan diperbarui sesuai input pengguna.

  **Kesimpulan:** Kriteria telah terpenuhi.

### 5.3 State Management untuk Inventory
- **Kriteria:**
  - Data inventory harus disimpan menggunakan mekanisme state (e.g., session, localStorage).
- **Implementasi di Kode:**
  - Data inventory disimpan sementara menggunakan session untuk menjaga konsistensi antar halaman.

  **Kesimpulan:** Kriteria telah terpenuhi.

---

## Bagian 6: Sistem Login (Tambahan Kode Baru)

### 6.1 Validasi Login
- **Kriteria:**
  - Sistem harus dapat memvalidasi email dan password untuk otentikasi pengguna.
- **Implementasi di Kode:**
  - Input email dan password divalidasi menggunakan filter dan trim di PHP.
  - Sistem memeriksa apakah email pengguna terdaftar di database.
  - Password diverifikasi menggunakan `password_verify()`.

  **Kesimpulan:** Kriteria telah terpenuhi.

### 6.2 Keamanan Login
- **Kriteria:**
  - Password harus dienkripsi menggunakan metode hashing yang aman.
  - Validasi input dilakukan untuk mencegah SQL Injection.
- **Implementasi di Kode:**
  - Password disimpan di database dalam bentuk hash.
  - Query SQL menggunakan prepared statement untuk mencegah SQL Injection.

  **Kesimpulan:** Kriteria telah terpenuhi.

### 6.3 Antarmuka Login
- **Kriteria:**
  - Form login harus memiliki validasi input di sisi client menggunakan JavaScript.
  - Sistem harus menampilkan pesan error jika login gagal.
- **Implementasi di Kode:**
  - Checkbox "I agree with the terms of service" harus dicentang sebelum tombol login aktif.
  - Pesan error ditampilkan di layar jika login gagal.

  **Kesimpulan:** Kriteria telah terpenuhi.

---

## Bagian 7: Sistem Registrasi (Kode Baru Ditambahkan)

### 7.1 Validasi Data Registrasi
- **Kriteria:**
  - Input email, username, password, dan konfirmasi password divalidasi di sisi server.
  - Password harus memenuhi ketentuan keamanan.
- **Implementasi di Kode:**
  - Validasi dilakukan untuk memastikan semua field terisi dan email memiliki format valid.
  - Sistem memastikan password dan konfirmasi password cocok.

  **Kesimpulan:** Kriteria telah terpenuhi.

### 7.2 Keamanan Registrasi
- **Kriteria:**
  - Password harus dienkripsi menggunakan metode hashing yang aman.
  - Sistem harus mencegah pendaftaran email yang sudah ada.
- **Implementasi di Kode:**
  - Password dienkripsi menggunakan `password_hash()`.
  - Sistem memeriksa apakah email telah terdaftar sebelum menyimpan data baru.

  **Kesimpulan:** Kriteria telah terpenuhi.

### 7.3 Antarmuka Registrasi
- **Kriteria:**
  - Form registrasi harus interaktif dengan validasi client-side.
  - Pesan kesalahan atau sukses ditampilkan kepada pengguna.
- **Implementasi di Kode:**
  - Checkbox "I agree with the terms of service" harus dicentang sebelum tombol registrasi aktif.
  - Pesan sukses atau error ditampilkan dalam notifikasi.

  **Kesimpulan:** Kriteria telah terpenuhi.

### Bagian Bonus: Hosting Aplikasi Web (Bobot: 20%)
1. Langkah-langkah Hosting Aplikasi Web (5%)
   - **Kriteria:**
      - Pastikan semua file aplikasi siap, termasuk database dump.
      - Pilih penyedia hosting sesuai kebutuhan aplikasi (shared, VPS, atau cloud hosting).
      - Unggah file aplikasi ke server menggunakan FTP/SFTP.
      - Impor database ke server hosting dan perbarui file koneksi database.
      - Hubungkan domain dengan server hosting (update DNS settings).
      - Uji aplikasi web untuk memastikan semua fungsi berjalan normal.
     
2. Penyedia Hosting yang Dipilih (5%)
   - **Pilihan:**
      - Hosting Niagahoster, Hostinger, Jagoanhosting, AWS (untuk aplikasi kecil hingga skala besar).
   - **Alasan:**
      - Dokumentasi lengkap, keamanan tinggi, dan fleksibilitas untuk aplikasi berbasis PHP/SQL.
     
3. Keamanan Aplikasi Web (5%)
   - **Langkah-Langkah:**
      - Gunakan HTTPS dengan sertifikat SSL.
      - Validasi input user untuk mencegah SQL Injection atau XSS.
      - Batasi akses database dengan credential khusus.
      - Lakukan pembaruan rutin pada library/framework.
      - Aktifkan firewall atau WAF (Web Application Firewall) pada server.

4. Konfigurasi Server (5%)
   - **Teknologi:**
      - Apache atau Nginx sebagai web server.
      - Konfigurasi PHP versi terbaru dan modul yang dibutuhkan.
      - Optimalkan database (MySQL/MariaDB) untuk performa.
----

# Kesimpulan Akhir
Kode yang dibuat telah memenuhi seluruh kriteria penilaian
