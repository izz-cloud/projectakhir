# Sistem Informasi UKS (Unit Kesehatan Sekolah)

Sistem informasi berbasis web untuk mengelola pengajuan keluhan kesehatan siswa di sekolah. Aplikasi ini memungkinkan siswa untuk mengajukan keluhan kesehatan dan admin UKS untuk menindaklanjuti dengan memberikan diagnosis dan tindakan.

## 📋 Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Struktur Project](#struktur-project)
- [Cara Menjalankan Project](#cara-menjalankan-project)
- [Fitur dan Peningkatan](#fitur-dan-peningkatan)
- [Aksesibilitas](#aksesibilitas)
- [Refleksi Pembelajaran](#refleksi-pembelajaran)

## ✨ Fitur Utama

### Untuk Siswa
- **Registrasi dan Login** - Sistem autentikasi yang aman dengan validasi form
- **Pengajuan Keluhan** - Form untuk mengajukan keluhan kesehatan dengan validasi real-time
- **Dashboard Siswa** - Melihat riwayat pengajuan dan status keluhan
- **Pencarian** - Fitur pencarian untuk menemukan pengajuan tertentu dengan cepat

### Untuk Admin UKS
- **Dashboard Admin** - Overview semua pengajuan dari siswa
- **Respon Keluhan** - Memberikan diagnosis dan tindakan untuk setiap keluhan
- **Tracking** - Melacak status pengajuan yang sudah ditindaklanjuti

## 🛠 Teknologi yang Digunakan

- **Frontend:**
  - HTML5 (semantic markup)
  - CSS3 (responsive design, animations, transitions)
  - JavaScript (ES6+, DOM manipulation, Fetch API)
  
- **Backend:**
  - PHP (server-side logic)
  - MySQL (database management)
  
- **Fitur Modern:**
  - Fetch API untuk dynamic content loading
  - Client-side form validation
  - Responsive design dengan media queries
  - Accessibility features (ARIA attributes)

## 📁 Struktur Project

```
SistemUKS/
├── auth-uks/              # Modul autentikasi
│   ├── login.php          # Halaman login
│   ├── register.php       # Halaman registrasi
│   ├── proses_login.php   # Proses login
│   ├── proses_register.php # Proses registrasi
│   ├── koneksi.php        # Koneksi database
│   ├── style.css          # Styling untuk auth pages
│   ├── transisi.js        # Transisi dan animasi
│   └── form-validation.js # Validasi form
├── api/                   # API endpoints
│   └── get_stats.php      # API untuk statistik dashboard
├── js/                    # JavaScript modules
│   └── dashboard.js       # Logika dashboard
├── images/                # Assets gambar
│   └── bgs.jpg           # Background image
├── dashboard.php          # Dashboard siswa
├── admin_dashboard.php    # Dashboard admin
├── admin_tracking.php     # Halaman tracking admin
├── proses_pengajuan.php   # Proses pengajuan keluhan
├── proses_admin.php       # Proses respon admin
├── dash.css              # Styling dashboard
├── index.php             # Landing page
└── README.md             # Dokumentasi project
```

## 🚀 Cara Menjalankan Project

### Prasyarat
- Web server (XAMPP, Laragon, atau sejenisnya)
- PHP 7.4 atau lebih tinggi
- MySQL/MariaDB
- Browser modern (Chrome, Firefox, Edge)

### Langkah-langkah

1. **Clone atau download project**
   ```bash
   # Jika menggunakan git
   git clone [repository-url]
   ```

2. **Setup Database**
   - Buka phpMyAdmin atau MySQL client
   - Buat database baru (contoh: `uks_db`)
   - Import struktur database (jika ada file SQL)
   - Atau buat tabel manual:
     ```sql
     CREATE TABLE users (
         id INT PRIMARY KEY AUTO_INCREMENT,
         username VARCHAR(50) UNIQUE,
         email VARCHAR(100) UNIQUE,
         password VARCHAR(255)
     );
     
     CREATE TABLE pengajuan_uks (
         id INT PRIMARY KEY AUTO_INCREMENT,
         user_id INT,
         nama_siswa VARCHAR(100),
         kelas VARCHAR(20),
         keluhan TEXT,
         status VARCHAR(20) DEFAULT 'Menunggu',
         diagnosis TEXT,
         tindakan TEXT,
         tanggal_pengajuan DATETIME DEFAULT CURRENT_TIMESTAMP,
         tanggal_respon DATETIME,
         FOREIGN KEY (user_id) REFERENCES users(id)
     );
     ```

3. **Konfigurasi Koneksi Database**
   - Edit file `auth-uks/koneksi.php`
   - Sesuaikan dengan konfigurasi database Anda:
     ```php
     $host = "localhost";
     $user = "root";
     $pass = "";
     $db = "uks_db";
     ```

4. **Jalankan Web Server**
   - Jika menggunakan XAMPP: Start Apache dan MySQL
   - Jika menggunakan Laragon: Start semua service
   - Akses project melalui browser:
     ```
     http://localhost/SistemUKS/
     ```

5. **Test Aplikasi**
   - Buka halaman utama (akan redirect ke login)
   - Buat akun baru melalui halaman registrasi
   - Login dengan akun yang sudah dibuat
   - Coba fitur pengajuan keluhan

## 🎯 Fitur dan Peningkatan

### 1. Form Validation
- **Client-side validation** dengan feedback real-time
- Validasi email format, password strength, dan format kelas
- Pesan error yang jelas dan user-friendly
- Validasi HTML5 dengan custom JavaScript

### 2. Responsive Design
- **Mobile-first approach** dengan media queries
- Breakpoints untuk tablet (768px) dan mobile (480px)
- Layout yang adaptif untuk berbagai ukuran layar
- Touch-friendly interface untuk perangkat mobile

### 3. Accessibility (A11y)
- **ARIA attributes** untuk screen readers
- Proper label associations untuk form inputs
- Semantic HTML5 elements
- Keyboard navigation support
- Focus indicators yang jelas

### 4. User Experience
- **Smooth animations** dan transitions
- Loading states untuk form submissions
- Toast notifications untuk feedback
- Search functionality dengan real-time filtering
- Password visibility toggle

### 5. Code Quality
- **Modular JavaScript** dengan separation of concerns
- Commented code untuk dokumentasi
- Meaningful variable dan function names
- Reusable functions untuk validasi

### 6. Modern Web Features
- **Fetch API** untuk dynamic content loading
- ES6+ JavaScript syntax
- CSS animations dan transitions
- Progressive enhancement

## ♿ Aksesibilitas

Project ini mengimplementasikan best practices untuk aksesibilitas web:

- **ARIA Labels**: Semua interactive elements memiliki label yang jelas
- **Semantic HTML**: Penggunaan elemen HTML5 yang tepat (header, nav, main, etc.)
- **Keyboard Navigation**: Semua fitur dapat diakses menggunakan keyboard
- **Screen Reader Support**: Struktur yang ramah untuk screen readers
- **Color Contrast**: Kontras warna yang memadai untuk readability
- **Form Labels**: Setiap input memiliki label yang terhubung dengan proper `for` attribute

## 📚 Refleksi Pembelajaran

### Apa yang Dipelajari

1. **Form Validation**
   - Memahami pentingnya validasi di client-side dan server-side
   - Belajar membuat user-friendly error messages
   - Implementasi real-time validation untuk UX yang lebih baik

2. **Responsive Web Design**
   - Menggunakan media queries untuk berbagai breakpoints
   - Memahami mobile-first approach
   - Belajar membuat layout yang fleksibel dengan CSS Grid dan Flexbox

3. **Accessibility**
   - Pentingnya membuat website yang dapat diakses semua orang
   - Implementasi ARIA attributes
   - Best practices untuk semantic HTML

4. **Modern JavaScript**
   - Penggunaan Fetch API untuk asynchronous operations
   - Event-driven programming
   - DOM manipulation yang efisien
   - Modular code organization

5. **User Experience**
   - Pentingnya feedback yang jelas untuk user actions
   - Animasi dan transitions untuk meningkatkan UX
   - Loading states dan error handling

### Tantangan yang Dihadapi

1. **Form Validation Logic**
   - **Tantangan**: Membuat validasi yang komprehensif tanpa mengganggu UX
   - **Solusi**: Implementasi real-time validation dengan visual feedback yang jelas

2. **Responsive Design**
   - **Tantangan**: Membuat layout yang konsisten di berbagai device
   - **Solusi**: Penggunaan CSS Grid dan Flexbox dengan media queries yang tepat

3. **Accessibility Implementation**
   - **Tantangan**: Memahami ARIA attributes dan kapan menggunakannya
   - **Solusi**: Belajar dari dokumentasi WAI-ARIA dan testing dengan screen readers

4. **Code Organization**
   - **Tantangan**: Menjaga code tetap maintainable dan readable
   - **Solusi**: Separation of concerns, modular JavaScript, dan meaningful comments

### Peningkatan di Masa Depan

- Implementasi dark mode
- Notifikasi real-time menggunakan WebSockets
- Export data ke PDF atau Excel
- Grafik dan visualisasi data
- Multi-language support
- Unit testing untuk JavaScript functions

## 📝 Catatan

- Project ini dibuat untuk tujuan pembelajaran
- Pastikan database sudah dikonfigurasi dengan benar sebelum menjalankan
- Gunakan password yang kuat untuk production environment
- Selalu validasi input di server-side untuk keamanan

## 👨‍💻 Author

Dibuat sebagai project pembelajaran web development

---

**Versi:** 1.0  
**Last Updated:** 2024


