# MEMORY.md — Memori Terkurasi Lintas-Agen SI-VERIF BLUD

> **Aturan Perawatan**: Berkas ini adalah **Single Source of Truth (SSOT)** memori jangka panjang untuk proyek **SI-VERIF BLUD** (**maksimal 300 baris**). Setiap keputusan arsitektur, jebakan teknis, dan perubahan skema wajib dicatat secara ringkas di sini serta disinkronkan ke `claude-mem`.

---

## 1. Keputusan Arsitektur Aktif (ADR Index)

- **[2026-08-07] Stack Inti Laravel 13 + Filament v5.0 + Shield v4.3** → Membangun sistem verifikasi berjenjang SPJ BLUD menggunakan **Laravel 13.8** dan **Filament v5.0** dengan manajemen hak akses berbasis **Spatie Permission** & **Filament Shield**.
- **[2026-08-07] Tema Visual Glassmorphism Indigo & Split-Screen Login** → Mengadopsi desain custom di [`public/css/glassmorphism-indigo.css`](file:///c:/laragon/www/si-verif-blud/public/css/glassmorphism-indigo.css) dengan latar *animated floating blobs*, warna utama Indigo (`#4f46e5` / `#6366f1`), font `Inter`, mode terang terkunci (`->darkMode(false)`), dan halaman login 2-kolom interaktif ([`Login.php`](file:///c:/laragon/www/si-verif-blud/app/Filament/Pages/Auth/Login.php)).
- **[2026-08-07] Penyimpanan Lampiran Hibrida (`file_path` JSON Repeater)** → Untuk menghemat kuota disk hosting cPanel, kolom `dokumen_pengeluarans.file_path` diubah menjadi tipe JSON yang mendukung 2 mode per item: unggah langsung berkas PDF (**maksimal 1MB** di `storage/app/public/dokumen_pengeluaran`) atau tautan **Google Drive** untuk berkas berukuran > 1MB.
- **[2026-08-10] Konsolidasi Notifikasi ke Tabel Bawaan Filament (`notifications`)** → Tabel kustom `notifikasis` dihapus (migration `2026_08_10_050000_drop_notifikasis_table.php`) dan seluruh pengiriman notifikasi lintas-role distandarisasi menggunakan `Filament\Notifications\Notification::make()->sendToDatabase(...)` pada tabel standar `notifications`.
- **[2026-08-13] Master Dinamis Sumber Dana & 27 Jenis Dokumen** → Sumber dana (`BLUD`, `APBD`, dll.) dan 27 jenis dokumen pengeluaran SPJ dipisahkan ke tabel master [`sumber_danas`](file:///c:/laragon/www/si-verif-blud/app/Models/SumberDana.php) dan [`jenis_dokumens`](file:///c:/laragon/www/si-verif-blud/app/Models/JenisDokumen.php) agar dapat dikelola via panel Admin.
- **[2026-11-09] Standarisasi Lapisan Instruksi & Memory Agent** → Menerapkan spesifikasi terbuka [agents.md](https://agents.md/) (`AGENTS.md`), memori terkurasi (`MEMORY.md`), entrypoint Antigravity (`GEMINI.md`), dan aturan sinkronisasi `.agents/rules/claude-mem.md`.
- **[2026-11-09] Mode Draft (`STATUS_DRAFT`), Transisi Mundur Status, & Akurasi Dashboard** → Menambahkan `DokumenPengeluaran::STATUS_DRAFT` (terisolasi untuk PPTK pembuat & Admin, lampiran opsional saat draft, aksi `ajukan_draft`), membuka aksi `verifikasi_kembalikan` pada status `diverifikasi`/`disahkan` serta `kembalikan_tahap` (mundur 1 tahap), mengisolasi `DokumenChart` per `pptk_id`, dan menyelaraskan statistik seluruh role dengan filter default `'all'`.

---

## 2. Jebakan Teknis & Konvensi Penting (Wajib Diingat)

- **API Schema Filament v5 (`Filament\Schemas\Schema`)**:
  - Di Filament v5, metode `form(Schema $schema): Schema` dan `infolist(Schema $schema): Schema` menerima `Filament\Schemas\Schema`. Komponen tata letak seperti `Section`, `Grid`, dan `Tabs\Tab` berada di namespace `Filament\Schemas\Components\*`.
- **Jebakan CSS `backdrop-filter` pada Modal Filament**:
  - Di `public/css/glassmorphism-indigo.css`, efek `backdrop-filter: blur(20px)` hanya diterapkan pada `.fi-sidebar`, `.fi-topbar`, dan `.fi-sidebar-header`. **Jangan pernah** menambahkan `backdrop-filter` pada `.fi-section`, `.fi-wi-stats-overview-stat`, `.fi-ta`, atau `.fi-ta-ctn` karena properti tersebut menciptakan *stacking context* baru yang membuat modal aksi Filament (`verifikasi_lolos`, `lihat_lampiran_modal`, dll.) terjebak di dalam tabel.
- **Duplikasi Aksi Workflow di Tabel & Halaman Detail**:
  - Tombol aksi workflow (`kirim_ulang`, `verifikasi_lolos`, `verifikasi_kembalikan`, `sahkan`, `bayar`, `arsipkan`) didefinisikan baik pada baris tabel ([`DokumenPengeluaransTable.php`](file:///c:/laragon/www/si-verif-blud/app/Filament/Resources/DokumenPengeluarans/Tables/DokumenPengeluaransTable.php)) maupun header halaman detail ([`ViewDokumenPengeluaran.php`](file:///c:/laragon/www/si-verif-blud/app/Filament/Resources/DokumenPengeluarans/Pages/ViewDokumenPengeluaran.php)). Jika mengubah aturan visibilitas, form modal, atau notifikasi, **perbarui keduanya secara serempak**.
- **Guard `auth()->check()` pada Hook `DokumenPengeluaran::booted()`**:
  - Event `static::created` pada [`DokumenPengeluaran.php`](file:///c:/laragon/www/si-verif-blud/app/Models/DokumenPengeluaran.php) mengirimkan notifikasi ke role `verifikator`. Guard `if (!auth()->check()) return;` wajib dipertahankan agar eksekusi `php artisan db:seed` (`DummyDokumenSeeder`) atau CLI Tinker tidak gagal.
- **Format Kode Dokumen Otomatis**:
  - Dibangkitkan otomatis saat `creating` dengan pola `BLUD-YYYY-MM-XXXX` (mis. `BLUD-2026-11-0001`).
- **Penanganan Input Nominal (`RawJs` Money Mask)**:
  - Field `nominal` di [`DokumenPengeluaranForm.php`](file:///c:/laragon/www/si-verif-blud/app/Filament/Resources/DokumenPengeluarans/Schemas/DokumenPengeluaranForm.php) menggunakan `mask(RawJs::make('$money($input, ".", ",", 0)'))` dengan `stripCharacters('.')` dan `dehydrateStateUsing` yang membersihkan titik/koma sebelum disimpan sebagai `float`/`decimal(15,2)`.
- **Isolasi Data & Tab Default per Role**:
  - `DokumenPengeluaranResource::getEloquentQuery()` membatasi `pptk` hanya pada `pptk_id = $user->id` dan `rekanan` hanya pada status `dibayar` & `diarsipkan`.
  - `ListDokumenPengeluarans::getDefaultActiveTab()` mengarahkan tab awal secara cerdas: `verifikator` ➔ `'diajukan'`, `ppk` ➔ `'diverifikasi'`, `bendahara` ➔ `'disahkan'`, lainnya ➔ `'semua'`.

---

## 3. Referensi Domain, 6 Bidang, & Akun Seeder Default

### 3.1 6 Bidang / Unit Kerja (SK Direktur No. 900.1.15/004/RSJ-2026)
1. **Penunjang** (`pptk.penunjang@blud.com`)
2. **Umum** (`pptk.umum@blud.com`)
3. **SDM dan Litbang** (`pptk.sdm@blud.com`)
4. **Pelayanan Medis** (`pptk.medis@blud.com`)
5. **Keperawatan** (`pptk.keperawatan@blud.com`)
6. **Keuangan** (`pptk.keuangan@blud.com`)

### 3.2 Akun Fungsional Default (`DatabaseSeeder` — Password Default: `password`)
- **Super Admin**: `superadmin@blud.com` (`super_admin` — Password: `12345678`)
- **Admin Keuangan**: `admin@blud.com` (`admin`)
- **Verifikator**: `verifikator1@blud.com` (`verifikator`)
- **PPK BLUD**: `ppk@blud.com` (`ppk`)
- **Bendahara Pengeluaran**: `bendahara@blud.com` (`bendahara`)
- **Manajemen RS**: `manajemen@blud.com` (`manajemen`)
- **Rekanan**: `rekanan@blud.com` (`rekanan`)

### 3.3 5 Kategori Jenis Kesalahan Baseline (`jenis_kesalahans`)
1. `Dokumen tidak lengkap`
2. `Format tidak sesuai`
3. `Tanda tangan/pengesahan kurang`
4. `Nominal tidak sesuai`
5. `Lainnya`

---

## 4. Riwayat Eksekusi & Milestone Proyek

| Tanggal | Kategori | Ringkasan Eksekusi & Berkas Terkait |
|---|---|---|
| **2026-08-07** | Core Schema & RBAC | Pembuatan migrasi utama (`bidangs`, `dokumen_pengeluarans`, `jenis_kesalahans`, `verifikasis`, `riwayat_koreksis`, `pengesahans`, `pembayarans`, `audit_trails`, `jenis_dokumens`), konfigurasi Spatie Permission & Filament Shield, serta `AuditTrailObserver`. |
| **2026-08-07** | Hybrid Attachment | Migrasi `file_path` menjadi JSON array pada `dokumen_pengeluarans` untuk mendukung multi-lampiran (unggah PDF <= 1MB & link Google Drive). |
| **2026-08-13** | Master Sumber Dana | Penambahan tabel & resource `SumberDana` serta konfigurasi form dinamis `DokumenPengeluaranForm`. |
| **2026-08-15+** | UI Theme & Pages | Implementasi tema `glassmorphism-indigo.css`, halaman login split-screen dengan pratinjau statistik real-time, halaman ceklis interaktif `KelengkapanBerkasPage`, halaman `PanduanPage`, serta timeline visual 5-tahap di `ViewDokumenPengeluaran`. |
| **2026-11-09** | Agent & Memory | Penerapan standar `AGENTS.md`, inisialisasi memori persisten `MEMORY.md`, `GEMINI.md`, dan aturan sinkronisasi `.agents/rules/claude-mem.md`. |
| **2026-11-09** | Blackbox Follow-up | Implementasi penyimpanan `draft` (`STATUS_DRAFT` + `ajukan_draft`), aksi mundur status (`verifikasi_kembalikan` lintas tahap & `kembalikan_tahap`), isolasi `DokumenChart` untuk PPTK Keuangan, serta perbaikan kalkulasi `StatsOverviewWidget` di seluruh role. |

