# 🎓 Sistem Manajemen Data Alumni

Proyek **Manajemen Data Alumni** adalah aplikasi berbasis web yang dirancang untuk mengelola, melacak, dan mendokumentasikan data alumni (*Tracer Study*). Sistem ini mempermudah institusi dalam memetakan perkembangan karir alumni, mempererat jejaring komunikasi, serta menyajikan data secara transparan dan dinamis. Built dengan performa tangguh PHP Native dan tampilan modern menggunakan Tailwind CSS v4.

---

## 🚀 Fitur Utama

Sistem ini dirancang dengan fokus pada kemudahan navigasi (UI/UX) dan fungsionalitas yang solid:

* **Sistem Autentikasi Keamanan:** Mengamankan halaman dashboard menggunakan session PHP untuk mencegah akses ilegal.
* **Hak Akses Multi-Role:** Memisahkan hak operasi sistem antara akun **Admin** dan akun **User**.
* **Operasi CRUD Penuh (Khusus Admin):** Memungkinkan manipulasi data alumni secara dinamis mulai dari menambah (*Create*), menampilkan (*Read*), mengubah (*Update*), hingga menghapus (*Delete*) data.
* **Fitur Pencarian Fleksibel:** Memudahkan pencarian data secara instan berdasarkan kriteria *Nama Lengkap*, *Tahun Lulus*, maupun *Jurusan/Program Studi*.
* **Desain Responsif & Interaktif:** Menggunakan Tailwind CSS v4 dengan tata letak *Micro-interactions* yang ramah diakses via *smartphone*, tablet, maupun desktop.
* **Trik Anti-Gagal Sticky Footer:** Layout modern yang menjamin posisi *footer* tetap berada di dasar layar meskipun data di dalam tabel sedang kosong.

---

## 👥 Hak Akses (Multi-Role)

Aplikasi ini membagi hak interaksi pengguna menjadi dua tingkatan utama:

| Hak Akses | Fitur Dashboard Utama | Pencarian Data | Tambah Data | Edit Data | Hapus Data |
| :--- | :---: | :---: | :---: | :---: | :---: |
| 🔴 **Admin** | ✅ Ya | ✅ Ya | ✅ Ya | ✅ Ya | ✅ Ya |
| 🔵 **User** | ✅ Ya | ✅ Ya | ❌ Tidak | ❌ Tidak | ❌ Tidak |

---

## 🛠️ Teknologi yang Digunakan

* **Back-End Core:** PHP Native
* **Front-End Styling:** Tailwind CSS v4 (Engine via CDN Browser)
* **Database Management:** MySQL / MariaDB
* **Icons & Visual Kit:** Lucide Icons & SVG Custom UI

---

## 📂 Struktur Direktori Proyek

```text
DATA-ALUMNI1/
│
├── auth/
│   ├── login.php         # Halaman masuk sistem (Admin/User)
│   └── register.php      # Halaman pendaftaran akun baru
│
├── dashboard.php         # Halaman utama Admin (Manajemen & Akses CRUD)
├── user.php              # Halaman utama User (Hanya Lihat & Cari Data)
├── tambah.php            # Form proses tambah data alumni baru
├── edit.php              # Form proses penyuntingan data alumni
├── hapus.php             # Skrip logika penghapusan data alumni
├── koneksi.php           # Skrip konfigurasi database MySQL
├── logout.php            # Skrip penghancur session login (Keluar)
└── index.php             # Landing page/Halaman beranda utama
