# AGENTS.md — SI-VERIF BLUD

> **Standard Compliance**: Dokumen ini mengikuti standar terbuka [agents.md](https://agents.md/) dan menjadi panduan utama untuk seluruh AI coding agents yang bekerja pada repositori **SI-VERIF BLUD** (*Sistem Informasi Verifikasi Dokumen Pengeluaran BLUD*).

---

## 0. Peta Berkas Instruksi & Memori Agen

| Berkas | Fungsi & Kapan Dibaca |
|---|---|
| `AGENTS.md` | **Wajib di awal sesi.** Konteks proyek, perintah dev/test/deploy, arsitektur Filament v5, alur status dokumen, dan guardrails. |
| `MEMORY.md` | **Wajib di awal sesi.** Memori terkurasi: keputusan arsitektur (ADR), jebakan teknis Filament v5 & CSS, matriks RBAC, dan riwayat fitur. |
| `GEMINI.md` | Entrypoint ringkas khusus Antigravity + protokol sinkronisasi `claude-mem`. |
| `.agents/rules/claude-mem.md` | Aturan selalu-aktif untuk sinkronisasi memori lintas sesi menggunakan `claude-mem` dan `MEMORY.md`. |

---

## 1. Ringkasan Proyek & Tech Stack

- **Nama Aplikasi**: **SI-VERIF BLUD** (*Sistem Informasi Verifikasi Dokumen Pengeluaran BLUD*).
- **Unit Pengampu**: Subbag Akuntansi, Verifikasi dan Perbendaharaan BLUD (berpedoman pada Permendagri No. 77 Tahun 2020 & SK Direktur No. 900.1.15/004/RSJ-2026).
- **Tech Stack Utama**:
  - **Backend & Runtime**: PHP 8.3+ / 8.4 (Laragon Windows), **Laravel 13.8+** (`laravel/framework: ^13.8`).
  - **Admin Panel & UI**: **Filament v5.0** (`filament/filament: ^5.0`), Livewire, Blade, dengan tema kustom **Glassmorphism Indigo** (`public/css/glassmorphism-indigo.css`).
  - **Otorisasi & RBAC**: **Spatie Laravel Permission** + **Filament Shield v4.3** (`bezhansalleh/filament-shield: ^4.3`).
  - **Asset Bundler & Styling**: **Vite 8**, **Tailwind CSS v4** (`@tailwindcss/vite`).
  - **Realtime & Notifikasi**: Filament Database Notifications (`notifications` table) + `laravel/reverb` & `pusher/pusher-php-server`.
  - **Database**: MySQL (`sistem_verifikasi_blud` di Laragon `127.0.0.1:3306`) untuk development/produksi; SQLite in-memory untuk automated testing (`phpunit.xml`).

---

## 2. Perintah Pengembangan, Build & Verifikasi

Sistem Windows lokal menggunakan Laragon. Pastikan binary PHP 8.3/8.4 Laragon berada di `PATH` saat menjalankan perintah CLI:

```powershell
$env:PATH = "C:\laragon\bin\php\php-8.3.26-Win32-vs16-x64;C:\laragon\bin\composer;" + $env:PATH

# 1. Instalasi & Persiapan Awal
composer install
npm install
php artisan migrate --seed
php artisan storage:link

# 2. Menjalankan Server Development
composer run dev
# Atau secara terpisah:
php artisan serve
npm run dev

# 3. Pengujian & Verifikasi Kualitas Kode (Wajib hijau sebelum tugas selesai)
php artisan test
./vendor/bin/pint --test
npm run build

# 4. Pemeriksaan Sintaks Cepat Berkas PHP
php -l app/Filament/Resources/DokumenPengeluarans/DokumenPengeluaranResource.php

# 5. Pembersihan Cache Filament & Laravel
php artisan optimize:clear
php artisan icons:cache
```

---

## 3. Struktur Direktori & Arsitektur

```text
si-verif-blud/
├── app/
│   ├── Filament/
│   │   ├── Pages/
│   │   │   ├── Auth/Login.php                # Custom split-screen login + statistik live
│   │   │   ├── Dashboard.php                 # Dashboard utama + filter periode (1D, 7D, 1M, 3M, YTD, All, Custom)
│   │   │   ├── KelengkapanBerkasPage.php     # Ceklis interaktif & lembar cetak kelengkapan berkas SPJ
│   │   │   └── PanduanPage.php               # Panduan penggunaan interaktif per role
│   │   ├── Resources/
│   │   │   ├── DokumenPengeluarans/          # Modul inti pengajuan & verifikasi berjenjang SPJ BLUD
│   │   │   │   ├── Pages/                    # List, Create, Edit, ViewDokumenPengeluaran
│   │   │   │   ├── RelationManagers/         # Verifikasis, RiwayatKoreksis, Pengesahans, Pembayarans
│   │   │   │   ├── Schemas/                  # DokumenPengeluaranForm.php (Filament v5 Schema)
│   │   │   │   └── Tables/                   # DokumenPengeluaransTable.php (Aksi workflow & modal lampiran)
│   │   │   ├── Bidangs/                      # Master 6 Bidang / Unit Kerja & PPTK penanggung jawab
│   │   │   ├── JenisDokumens/                # Master 27 Jenis Dokumen Pengeluaran
│   │   │   ├── JenisKesalahans/              # Master Kategori Kesalahan / Alasan Pengembalian
│   │   │   ├── SumberDanas/                  # Master Sumber Dana (BLUD, APBD)
│   │   │   ├── Users/                        # Manajemen Pengguna & Penugasan Role/Bidang
│   │   │   └── AuditTrails/                  # Log Jejak Audit (Read-only monitoring)
│   │   └── Widgets/                          # WelcomeWidget, StatsOverviewWidget, & 4 Grafik Analitik
│   ├── Models/                               # DokumenPengeluaran, Verifikasi, RiwayatKoreksi, Pengesahan, Pembayaran, dll.
│   ├── Observers/
│   │   └── AuditTrailObserver.php            # Pencatatan otomatis jejak audit ke tabel audit_trails
│   ├── Policies/                             # Policy otorisasi berbasis Filament Shield
│   └── Providers/
│       └── Filament/AdminPanelProvider.php   # Konfigurasi panel /admin, navigasi, tema, & render hooks
├── database/
│   ├── migrations/                           # Skema tabel aplikasi, permission Spatie, & notifikasi
│   └── seeders/                              # DatabaseSeeder (8 Role, 6 Bidang, 27 Jenis Dokumen, 13 User default)
├── public/
│   └── css/glassmorphism-indigo.css          # Tema visual utama Glassmorphism Indigo & split-login styling
├── resources/views/filament/                 # Blade views kustom (login, dashboard filter, kelengkapan-berkas, panduan)
└── .cpanel.yml                               # Pipeline deployment otomatis ke cPanel (/home/besignla/public_html)
```

---

## 4. Alur Kerja Status Dokumen (State Machine) & RBAC

### 4.1 Siklus Hidup `DokumenPengeluaran`
Gunakan konstanta resmi pada `App\Models\DokumenPengeluaran`:

```text
[PPTK Buat Ajuan]
       │
       ▼
  ┌──────────┐     (Verifikator: Kembalikan + Catat RiwayatKoreksi)     ┌──────────────┐
  │ diajukan │ ───────────────────────────────────────────────────────► │ dikembalikan │
  └────┬─────┘ ◄─────────────────────────────────────────────────────── └──────────────┘
       │           (PPTK: Perbaiki Berkas & Aksi "Ajukan Ulang")
       │ (Verifikator: Aksi "Verifikasi Lolos")
       ▼
┌──────────────┐
│ diverifikasi │
└──────┬───────┘
       │ (PPK: Aksi "Sahkan Dokumen")
       ▼
  ┌──────────┐
  │ disahkan │
  └────┬─────┘
       │ (Bendahara: Aksi "Bayar / Input No. BKU" -> nomor_spj)
       ▼
  ┌──────────┐
  │ dibayar  │
  └────┬─────┘
       │ (Bendahara: Aksi "Arsipkan")
       ▼
 ┌────────────┐
 │ diarsipkan │
 └────────────┘
```

### 4.2 Matriks 8 Role Pengguna (`Spatie\Permission`)
1. `super_admin` & `admin`: Akses penuh seluruh resource, master data, user, dan manajemen izin Shield.
2. `pptk`: Hanya melihat & mengajukan dokumen pada bidangnya (`pptk_id = auth()->id()`), serta memperbaiki/mengajukan ulang dokumen berstatus `dikembalikan`.
3. `verifikator`: Memeriksa dokumen berstatus `diajukan`/`dikembalikan` -> menyetujui (`diverifikasi`) atau mengembalikan (`dikembalikan` + wajib pilih `jenis_kesalahan_id` & isi catatan).
4. `ppk`: Mengesahkan dokumen berstatus `diverifikasi` menjadi `disahkan`.
5. `bendahara`: Mencairkan dana dokumen berstatus `disahkan` dengan menginput **No. BKU** (`nomor_spj`) menjadi `dibayar`, lalu memindahkan ke `diarsipkan`.
6. `manajemen`: Memantau seluruh dasbor eksekutif, grafik waktu verifikasi, koreksi per bidang, detail dokumen, dan `AuditTrail` (read-only).
7. `rekanan`: Hanya melihat dokumen berstatus `dibayar` dan `diarsipkan` (read-only).

---

## 5. Aturan Emas & Larangan Keras (Guardrails)

1. **Konvensi Filament v5 (`Filament\Schemas\Schema`)**:
   - Proyek ini menggunakan **Filament v5.0**. Gunakan `Filament\Schemas\Schema` dan komponen `Filament\Schemas\Components\*` (`Section`, `Grid`, `Tabs\Tab`), **bukan** API Filament v3 lama (`Filament\Forms\Form` atau `Filament\Infolists\Infolist` sebagai tipe parameter utama).
2. **Jangan Hardcode String Status**:
   - Selalu gunakan konstanta model `DokumenPengeluaran::STATUS_DIAJUKAN`, `STATUS_DIVERIFIKASI`, `STATUS_DIKEMBALIKAN`, `STATUS_DISAHKAN`, `STATUS_DIBAYAR`, `STATUS_DIARSIPKAN`, dan `ALL_STATUSES`.
3. **Sinkronisasi Aksi Tabel & Halaman View**:
   - Aksi workflow (`kirim_ulang`, `verifikasi_lolos`, `verifikasi_kembalikan`, `sahkan`, `bayar`, `arsipkan`) terdapat di dua tempat: [`DokumenPengeluaransTable.php`](file:///c:/laragon/www/si-verif-blud/app/Filament/Resources/DokumenPengeluarans/Tables/DokumenPengeluaransTable.php) dan [`ViewDokumenPengeluaran.php`](file:///c:/laragon/www/si-verif-blud/app/Filament/Resources/DokumenPengeluarans/Pages/ViewDokumenPengeluaran.php). Setiap perubahan logika transisi status atau notifikasi **wajib** diselaraskan di kedua berkas tersebut.
4. **Struktur JSON Lampiran (`file_path`)**:
   - Kolom `file_path` di-cast sebagai `array` dan menyimpan repeater item dengan kunci `tipe_sumber` (`'upload'` untuk PDF maks 1MB di disk `public/dokumen_pengeluaran`, atau `'link'` untuk URL Google Drive > 1MB), `judul`, `file`, dan `link_drive`. Pertahankan kompatibilitas mundur pada `renderLampiranModal()`.
5. **Larangan `backdrop-filter` pada Container Tabel/Section**:
   - Di [`public/css/glassmorphism-indigo.css`](file:///c:/laragon/www/si-verif-blud/public/css/glassmorphism-indigo.css), **dilarang keras** menambahkan `backdrop-filter` pada `.fi-section`, `.fi-ta`, atau `.fi-ta-ctn` karena akan membuat *stacking context* baru yang menjebak modal `position: fixed` Filament.
6. **Jejak Audit & Notifikasi Database**:
   - Jangan mematikan `AuditTrailObserver` di `AppServiceProvider`. Pastikan mutasi status penting tetap memicu notifikasi database (`->sendToDatabase(...)`) ke aktor tahap berikutnya.
7. **Larangan Penggunaan Emoticon / Emoji**:
   - **Dilarang keras** menggunakan emoticon atau karakter emoji (seperti roket, kertas, centang, peringatan, dll.) pada kode sumber, label UI/form, tombol, notifikasi, dokumentasi, maupun respons percakapan agen. Gunakan ikon resmi **Heroicon** (`heroicon-o-*` / `heroicon-m-*`) atau SVG inline untuk elemen visual UI.

