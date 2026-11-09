# GEMINI.md — SI-VERIF BLUD (Antigravity Entrypoint)

> **Penting**: Jaga berkas ini tetap ringkas (< 3 KB) agar tidak membebani *context window*. Rincian arsitektur dan histori disimpan di [`AGENTS.md`](./AGENTS.md) dan [`MEMORY.md`](./MEMORY.md).

## Direktif Wajib Setiap Sesi

1. **Sinkronisasi Memori (`claude-mem` & `MEMORY.md`)**:
   - Di awal sesi, panggil tool `session_start_context` pada MCP server `claude-mem` (project: `si-verif-blud`) dan baca [`MEMORY.md`](./MEMORY.md).
   - Di akhir tugas yang mengubah arsitektur, alur status, skema database, atau memperbaiki bug penting, tambahkan entri ringkas (1–2 baris) di [`MEMORY.md`](./MEMORY.md) dan sinkronkan ke `claude-mem` sesuai [`.agents/rules/claude-mem.md`](./.agents/rules/claude-mem.md).
2. **Kepatuhan Standar Proyek (`AGENTS.md`)**:
   - Ikuti seluruh perintah CLI (Laragon PHP 8.3/8.4), struktur Filament v5 (`Filament\Schemas\Schema`), state machine 6 status `DokumenPengeluaran`, dan matriks 8 role di [`AGENTS.md`](./AGENTS.md).
3. **Konsistensi Aksi & UI**:
   - Setiap perubahan pada aksi verifikasi/pengesahan/pembayaran/lampiran wajib disinkronkan antara [`DokumenPengeluaransTable.php`](./app/Filament/Resources/DokumenPengeluarans/Tables/DokumenPengeluaransTable.php) dan [`ViewDokumenPengeluaran.php`](./app/Filament/Resources/DokumenPengeluarans/Pages/ViewDokumenPengeluaran.php).
   - Patuhi aturan tema Glassmorphism Indigo di [`public/css/glassmorphism-indigo.css`](./public/css/glassmorphism-indigo.css) (jangan memasang `backdrop-filter` pada `.fi-section` atau `.fi-ta`).
   - **Dilarang menggunakan emoticon/emoji** pada UI, label kode, dokumentasi, maupun respons agen (gunakan Heroicon atau SVG).
4. **Verifikasi Sebelum Selesai**:
   - Jalankan pemeriksaan sintaks `php -l`, `./vendor/bin/pint --test`, dan `php artisan test` sebelum menyatakan pekerjaan selesai.

