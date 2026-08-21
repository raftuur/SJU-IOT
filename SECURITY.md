# Security Policy

## Keamanan SJU-IOT

Keamanan merupakan bagian penting dalam pengembangan SJU-IOT.

## Melaporkan Masalah Keamanan

Jika kamu menemukan kerentanan keamanan pada project, jangan langsung mempublikasikannya sebagai GitHub Issue.

Laporkan masalah tersebut kepada maintainer repository secara privat.

Sertakan informasi berikut:

- Deskripsi masalah.
- Langkah untuk mereproduksi masalah.
- Dampak yang mungkin terjadi.
- Bukti atau screenshot jika diperlukan.
- Saran perbaikan jika tersedia.

## Informasi Sensitif

Jangan membagikan informasi berikut pada repository:

- Password.
- API Key.
- JWT Secret.
- Database credential.
- Access Token.
- File `.env`.

Gunakan environment variable untuk menyimpan konfigurasi yang bersifat rahasia.

## Penanganan Laporan

Setiap laporan keamanan akan diperiksa dan ditindaklanjuti sesuai tingkat risiko dan dampaknya terhadap sistem.

## Scope

Kebijakan ini berlaku untuk komponen utama SJU-IOT, termasuk:

- CodeIgniter 4 Web Application.
- Python AI Service.
- REST API.
- Database integration.
- Machine monitoring.
