# SJU-IOT

### Sampah Jadi Uang

Sistem **Reverse Vending Machine (RVM) berbasis Internet of Things (IoT)** yang dirancang untuk mendeteksi, memvalidasi, dan mencatat penukaran botol plastik menjadi **point digital**.

SJU-IOT mengintegrasikan **ESP32, ESP32-CAM, YOLO, Sensor Load Cell, Python, CodeIgniter 4, dan MySQL** untuk mendukung proses deteksi, transaksi, dan monitoring mesin.

---

## 📌 Tentang Project

SJU-IOT dikembangkan sebagai sistem otomatis untuk proses penukaran botol plastik.

Sistem memanfaatkan kamera untuk mengenali objek botol, sensor Load Cell untuk melakukan validasi berat, serta server untuk mengelola data mesin, pengguna, transaksi, dan point digital.

### Tujuan

- Mengotomatisasi proses penerimaan botol plastik.
- Melakukan deteksi objek menggunakan YOLO.
- Melakukan validasi berat menggunakan Load Cell.
- Menyimpan data transaksi secara terpusat.
- Menyediakan monitoring mesin secara realtime.
- Memberikan point digital kepada pengguna.

---

## ✨ Fitur Utama

- 🔍 Deteksi botol plastik menggunakan YOLO
- ⚖️ Validasi berat menggunakan Load Cell
- 📷 Akuisisi gambar menggunakan ESP32-CAM
- 📡 Komunikasi perangkat menggunakan ESP32
- 🤖 AI Service berbasis Python
- 🖥️ Dashboard web berbasis CodeIgniter 4
- 📊 Monitoring mesin dan sensor secara realtime
- 🔄 Machine Session
- 👤 Manajemen pengguna
- 🧾 Manajemen transaksi
- 💰 Point digital

---

## 🏗️ Arsitektur Sistem

SJU-IOT terdiri dari perangkat hardware, AI Service, aplikasi web, dan database.

```text
┌──────────────────────────────┐
│          HARDWARE            │
│                              │
│  ESP32 + ESP32-CAM           │
│  Load Cell + Sensor          │
└──────────────┬───────────────┘
               │
               │ HTTP / API
               ▼
┌──────────────────────────────┐
│         AI SERVICE           │
│                              │
│  Python + YOLO               │
│  Object Detection            │
└──────────────┬───────────────┘
               │
               │ Detection Result
               ▼
┌──────────────────────────────┐
│        WEB APPLICATION       │
│                              │
│  CodeIgniter 4               │
│  REST API                    │
│  Dashboard & Monitoring      │
└──────────────┬───────────────┘
               │
               ▼
┌──────────────────────────────┐
│           DATABASE           │
│                              │
│           MySQL              │
└──────────────────────────────┘
```

### Komponen Sistem

| Komponen | Peran |
|---|---|
| ESP32 | Mengontrol perangkat dan komunikasi dengan server |
| ESP32-CAM | Mengambil gambar untuk proses deteksi |
| Load Cell | Mengukur berat botol |
| AI Service | Memproses deteksi menggunakan YOLO |
| CodeIgniter 4 | Menangani aplikasi web dan API |
| MySQL | Menyimpan data sistem |

---

## 🔄 Alur Sistem

```text
Pengguna
   │
   ▼
Masukkan Botol
   │
   ▼
ESP32-CAM
   │
   ▼
Pengambilan Gambar
   │
   ▼
AI Service
   │
   ▼
YOLO Object Detection
   │
   ├── Tidak Valid ──► Botol Ditolak
   │
   ▼
Validasi Berat
   │
   ▼
Load Cell
   │
   ▼
Server / API
   │
   ▼
Transaksi
   │
   ▼
Point Digital
```

---

## 📁 Struktur Project

```text
SJU-IOT/
│
├── ai-service/
│   │
│   ├── app/
│   ├── models/
│   ├── services/
│   └── ...
│
├── sju-web/
│   │
│   ├── app/
│   ├── public/
│   ├── tests/
│   ├── writable/
│   └── ...
│
├── .gitignore
└── README.md
```

### AI Service

Folder `ai-service` digunakan untuk menjalankan proses **Artificial Intelligence** menggunakan Python dan YOLO.

Fungsi utamanya meliputi:

- Pemrosesan gambar.
- Deteksi objek botol.
- Penyediaan API untuk proses deteksi.
- Komunikasi antara AI Service dan aplikasi utama.

### Web Application

Folder `sju-web` merupakan aplikasi web berbasis **CodeIgniter 4**.

Aplikasi ini menangani:

- Dashboard
- User Management
- Machine Management
- Machine Session
- Monitoring
- Transaction
- Point Digital
- API

---

## 🛠️ Teknologi

| Teknologi | Penggunaan |
|---|---|
| ESP32 | Kontrol dan komunikasi perangkat |
| ESP32-CAM | Akuisisi gambar |
| YOLOv8 | Deteksi botol plastik |
| Python | AI Service |
| CodeIgniter 4 | Web Application |
| PHP | Backend Web |
| MySQL | Database |
| JavaScript | Interaksi frontend |
| Load Cell | Pengukuran berat |
| HX711 | Modul pembaca Load Cell |
| REST API | Komunikasi antar sistem |
| Git | Version Control |

---

## 📊 Monitoring

Dashboard SJU-IOT menyediakan monitoring terhadap:

- Status mesin
- Status koneksi
- Kondisi sensor
- Aktivitas mesin
- Machine Session
- Transaksi
- Data pengguna

Monitoring digunakan untuk membantu melihat kondisi mesin dan aktivitas sistem secara realtime.

---

## 🤖 AI Service

AI Service bertanggung jawab terhadap proses deteksi objek menggunakan model YOLO.

### Alur AI

```text
Image
  │
  ▼
Python AI Service
  │
  ▼
YOLO Model
  │
  ▼
Object Detection
  │
  ▼
Detection Result
  │
  ▼
Web Application
```

---

## 🔐 Keamanan

File konfigurasi yang berisi credential tidak disimpan di repository.

Contohnya:

```text
.env
```

File `.env` dibuat secara terpisah pada environment development dan deployment.

Repository juga mengabaikan file dan folder yang bersifat lokal atau merupakan hasil proses aplikasi melalui `.gitignore`.

---

## 🚀 Deployment

Project dapat dijalankan pada server dengan memisahkan beberapa layanan:

```text
Server
│
├── CodeIgniter 4
│
├── Python AI Service
│
└── MySQL
```

Konfigurasi environment dan database disesuaikan dengan server deployment.

---

## 📌 Status Project

**Development**

Project ini dikembangkan sebagai sistem Reverse Vending Machine berbasis IoT untuk mendukung proses penukaran botol plastik menjadi point digital.

---

## 👨‍💻 Developer

**Raftur**

**SJU-IOT - Sampah Jadi Uang**