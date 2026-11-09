---
trigger: always_on
description: Aturan wajib sinkronisasi memori persisten lintas sesi menggunakan claude-mem MCP server dan MEMORY.md pada proyek SI-VERIF BLUD.
---

# Mandatory Memory Agent & Claude-Mem Synchronization Rule

Aturan ini mengatur persistensi memori proyek **SI-VERIF BLUD** lintas sesi AI agent menggunakan berkas lokal [`MEMORY.md`](../../MEMORY.md) dan MCP server `claude-mem`.

## 1. Awal Sesi (Session Start & Context Retrieval)
- Pada awal setiap sesi atau sebelum melakukan modifikasi kode:
  1. Baca [`AGENTS.md`](../../AGENTS.md) dan [`MEMORY.md`](../../MEMORY.md) di root repositori.
  2. Panggil `session_start_context` melalui MCP server `claude-mem` dengan parameter `project: "si-verif-blud"` untuk memuat konteks historis.

## 2. Alur Pencarian Memori 3-Lapis (3-Layer Memory Workflow)
Saat mencari riwayat fitur, bugfix, atau keputusan terdahulu di `claude-mem`, **wajib** ikuti urutan hemat-token berikut:
1. **Layer 1 (`search`)**: Panggil `search(query, project="si-verif-blud")` untuk mendapatkan indeks beserta ID observasi (~50–100 token/hasil).
2. **Layer 2 (`timeline`)**: Panggil `timeline(anchor=ID, project="si-verif-blud")` bila membutuhkan konteks urutan kejadian di sekitar hasil pencarian.
3. **Layer 3 (`get_observations`)**: Panggil `get_observations(ids=[...])` **hanya** untuk ID relevan yang telah difilter. Jangan pernah mengambil detail penuh tanpa memfilter terlebih dahulu.

## 3. Pembaruan & Persistensi Memori (Memory Saving)
- Setiap kali menyelesaikan fitur baru, memperbaiki bug, mengubah skema/migrasi, atau mengambil keputusan arsitektur:
  1. Tambahkan entri indeks 1–2 baris pada bagian yang relevan di [`MEMORY.md`](../../MEMORY.md) (jaga ukuran berkas tetap di bawah 300 baris).
  2. Bangun atau perbarui knowledge corpus di `claude-mem` menggunakan `build_corpus` / `rebuild_corpus` bila ada perubahan besar pada modul.

