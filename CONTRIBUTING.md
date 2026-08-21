# Contributing to SJU-IOT

Terima kasih atas ketertarikan untuk berkontribusi pada project **SJU-IOT (Sampah Jadi Uang)**.

## Sebelum Berkontribusi

Sebelum melakukan perubahan, pastikan kamu memahami struktur project:

```text
SJU-IOT/
├── ai-service/
├── sju-web/
├── README.md
└── LICENSE
```

## Alur Kontribusi

1. Buat branch baru untuk perubahan.
2. Lakukan perubahan dan pengujian.
3. Commit perubahan dengan pesan yang jelas.
4. Push branch ke repository.
5. Buat Pull Request jika diperlukan.

Contoh:

```bash
git checkout -b feature/nama-fitur
```

Kemudian:

```bash
git add .
git commit -m "feat: tambah nama fitur"
git push origin feature/nama-fitur
```

## Format Commit

| Prefix | Penggunaan |
|---|---|
| `feat:` | Menambahkan fitur |
| `fix:` | Memperbaiki bug |
| `docs:` | Mengubah dokumentasi |
| `refactor:` | Merapikan kode |
| `test:` | Menambahkan atau memperbaiki test |
| `chore:` | Maintenance atau konfigurasi |

## Keamanan

Jangan commit informasi sensitif seperti:

- Password
- API Key
- JWT Secret
- Database credential
- Token
- File `.env`

Gunakan file `.env` untuk konfigurasi lokal.

## Pengujian

Sebelum melakukan Pull Request, pastikan:

- Aplikasi dapat dijalankan.
- API dapat digunakan.
- Tidak terdapat error baru.
- Fitur yang sudah ada tetap berjalan.

## Pull Request

Pull Request sebaiknya menjelaskan:

- Perubahan yang dilakukan.
- Alasan perubahan.
- Cara menguji perubahan.
- Screenshot jika perubahan berkaitan dengan tampilan.

## License

Project ini menggunakan lisensi yang tercantum pada file `LICENSE`.

Penggunaan dan distribusi project harus mengikuti ketentuan lisensi tersebut.