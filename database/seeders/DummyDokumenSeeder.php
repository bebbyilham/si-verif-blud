<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\DokumenPengeluaran;
use App\Models\JenisKesalahan;
use App\Models\Pembayaran;
use App\Models\Pengesahan;
use App\Models\RiwayatKoreksi;
use App\Models\User;
use App\Models\Verifikasi;
use Illuminate\Database\Seeder;

class DummyDokumenSeeder extends Seeder
{
    public function run(): void
    {
        $pptkMedis = User::where('email', 'pptk.medis@blud.com')->first();
        $pptkUmum = User::where('email', 'pptk.umum@blud.com')->first();
        $pptkPenunjang = User::where('email', 'pptk.penunjang@blud.com')->first();
        $pptkKeuangan = User::where('email', 'pptk.keuangan@blud.com')->first();
        $pptkSdm = User::where('email', 'pptk.sdm@blud.com')->first();
        $pptkKeperawatan = User::where('email', 'pptk.keperawatan@blud.com')->first();
        $verifikator = User::where('email', 'verifikator1@blud.com')->first();
        $ppk = User::where('email', 'ppk@blud.com')->first();
        $bendahara = User::where('email', 'bendahara@blud.com')->first();
        $jenisKesalahan = JenisKesalahan::first();

        if (! $pptkMedis || ! $verifikator || ! $ppk || ! $bendahara) {
            return;
        }

        // 1. Dokumen Diajukan (Menunggu Verifikasi)
        DokumenPengeluaran::firstOrCreate(
            ['kode_dokumen' => 'BLUD-2026-08-0001'],
            [
                'bidang_id' => $pptkMedis->bidang_id,
                'pptk_id' => $pptkMedis->id,
                'jenis_dokumen' => 'Belanja obat/alkes',
                'sumber_dana' => 'BLUD',
                'nominal' => 12500000.00,
                'tanggal_ajuan' => now()->subDays(5)->toDateString(),
                'status' => DokumenPengeluaran::STATUS_DIAJUKAN,
                'file_path' => [
                    ['judul' => 'Kwitansi Tagihan Obat', 'file' => 'dokumen_pengeluaran/sample_kwitansi.pdf'],
                    ['judul' => 'Surat Pesanan Farmasi', 'file' => 'dokumen_pengeluaran/sample_sp.pdf'],
                ],
                'keterangan' => 'Pengadaan obat-obatan RSJ triwulan III',
            ]
        );

        // 2. Dokumen Dikembalikan (Revisi) dengan Riwayat Koreksi
        $dok2 = DokumenPengeluaran::firstOrCreate(
            ['kode_dokumen' => 'BLUD-2026-08-0002'],
            [
                'bidang_id' => $pptkUmum?->bidang_id ?? $pptkMedis->bidang_id,
                'pptk_id' => $pptkUmum?->id ?? $pptkMedis->id,
                'jenis_dokumen' => 'Belanja barang ATK, barang cetakan dll',
                'sumber_dana' => 'BLUD',
                'nominal' => 4750000.00,
                'tanggal_ajuan' => now()->subDays(4)->toDateString(),
                'status' => DokumenPengeluaran::STATUS_DIKEMBALIKAN,
                'file_path' => [
                    ['judul' => 'Nota Pembelian Alat Tulis', 'file' => 'dokumen_pengeluaran/sample_nota.pdf'],
                ],
                'keterangan' => 'Pembelian ATK Subbag Umum',
            ]
        );

        if ($dok2->wasRecentlyCreated) {
            Verifikasi::create([
                'dokumen_id' => $dok2->id,
                'verifikator_id' => $verifikator->id,
                'hasil' => 'dikembalikan',
                'tanggal_verifikasi' => now()->subDays(3),
                'catatan' => 'Mohon lengkapi tanda tangan PPTK pada nota fisik.',
            ]);

            RiwayatKoreksi::create([
                'dokumen_id' => $dok2->id,
                'versi_ke' => 1,
                'jenis_kesalahan_id' => $jenisKesalahan?->id,
                'catatan_koreksi' => 'Mohon lengkapi tanda tangan PPTK pada nota fisik.',
                'tanggal_koreksi' => now()->subDays(3),
                'dikoreksi_oleh' => $verifikator->id,
            ]);
        }

        // 3. Dokumen Diverifikasi (Menunggu PPK)
        $dok3 = DokumenPengeluaran::firstOrCreate(
            ['kode_dokumen' => 'BLUD-2026-08-0003'],
            [
                'bidang_id' => $pptkPenunjang?->bidang_id ?? $pptkMedis->bidang_id,
                'pptk_id' => $pptkPenunjang?->id ?? $pptkMedis->id,
                'jenis_dokumen' => 'Belanja pemeliharaan komputer /AC dan elektronik lainnya',
                'sumber_dana' => 'BLUD',
                'nominal' => 28400000.00,
                'tanggal_ajuan' => now()->subDays(3)->toDateString(),
                'status' => DokumenPengeluaran::STATUS_DIVERIFIKASI,
                'file_path' => [
                    ['judul' => 'SPK Pemeliharaan AC', 'file' => 'dokumen_pengeluaran/sample_spk.pdf'],
                    ['judul' => 'BAST Pekerjaan', 'file' => 'dokumen_pengeluaran/sample_bast.pdf'],
                ],
                'keterangan' => 'Pemeliharaan berkala AC Central gedung utama',
            ]
        );

        if ($dok3->wasRecentlyCreated) {
            Verifikasi::create([
                'dokumen_id' => $dok3->id,
                'verifikator_id' => $verifikator->id,
                'hasil' => 'lolos',
                'tanggal_verifikasi' => now()->subDays(2),
                'catatan' => 'Dokumen lengkap dan benar.',
            ]);
        }

        // 4. Dokumen Disahkan (Menunggu Pembayaran)
        $dok4 = DokumenPengeluaran::firstOrCreate(
            ['kode_dokumen' => 'BLUD-2026-08-0004'],
            [
                'bidang_id' => $pptkMedis->bidang_id,
                'pptk_id' => $pptkMedis->id,
                'jenis_dokumen' => 'Belanja Makan dan Minuman Rapat',
                'sumber_dana' => 'BLUD',
                'nominal' => 15000000.00,
                'tanggal_ajuan' => now()->subDays(2)->toDateString(),
                'status' => DokumenPengeluaran::STATUS_DISAHKAN,
                'file_path' => [
                    ['judul' => 'Surat Pengajuan Uang Persediaan', 'file' => 'dokumen_pengeluaran/sample_up.pdf'],
                ],
                'keterangan' => 'Pengajuan Uang Persediaan (UP) bidang Medis',
            ]
        );

        if ($dok4->wasRecentlyCreated) {
            Verifikasi::create([
                'dokumen_id' => $dok4->id,
                'verifikator_id' => $verifikator->id,
                'hasil' => 'lolos',
                'tanggal_verifikasi' => now()->subDays(2),
                'catatan' => 'Verifikasi UP lolos.',
            ]);

            Pengesahan::create([
                'dokumen_id' => $dok4->id,
                'ppk_id' => $ppk->id,
                'tanggal_sah' => now()->subDay(),
                'catatan' => 'Disetujui untuk dicairkan oleh Bendahara.',
            ]);
        }

        // 5. Dokumen Dibayar (Menunggu Diarsipkan)
        $dok5 = DokumenPengeluaran::firstOrCreate(
            ['kode_dokumen' => 'BLUD-2026-08-0005'],
            [
                'bidang_id' => $pptkMedis->bidang_id,
                'pptk_id' => $pptkMedis->id,
                'jenis_dokumen' => 'Belanja pengadaan barang dan jasa',
                'sumber_dana' => 'BLUD',
                'nominal' => 52000000.00,
                'tanggal_ajuan' => now()->subDays(6)->toDateString(),
                'status' => DokumenPengeluaran::STATUS_DIBAYAR,
                'file_path' => [
                    ['judul' => 'SPJ Pengadaan Alkes', 'file' => 'dokumen_pengeluaran/sample_alkes.pdf'],
                ],
                'keterangan' => 'Pembayaran tagihan pengadaan alat kesehatan',
            ]
        );

        if ($dok5->wasRecentlyCreated) {
            Verifikasi::create([
                'dokumen_id' => $dok5->id,
                'verifikator_id' => $verifikator->id,
                'hasil' => 'lolos',
                'tanggal_verifikasi' => now()->subDays(5),
                'catatan' => 'Lolos verifikasi.',
            ]);

            Pengesahan::create([
                'dokumen_id' => $dok5->id,
                'ppk_id' => $ppk->id,
                'tanggal_sah' => now()->subDays(4),
                'catatan' => 'Disahkan PPK.',
            ]);

            Pembayaran::create([
                'dokumen_id' => $dok5->id,
                'bendahara_id' => $bendahara->id,
                'tanggal_bayar' => now()->subDays(2),
                'nomor_spj' => 'BKU-2026/08/005',
                'status_bayar' => 'Lunas',
            ]);
        }

        // 6. Dokumen Diarsipkan
        $dok6 = DokumenPengeluaran::firstOrCreate(
            ['kode_dokumen' => 'BLUD-2026-08-0006'],
            [
                'bidang_id' => $pptkPenunjang?->bidang_id ?? $pptkMedis->bidang_id,
                'pptk_id' => $pptkPenunjang?->id ?? $pptkMedis->id,
                'jenis_dokumen' => 'Belanja Jasa telepon, air, listrik, internet dll',
                'sumber_dana' => 'BLUD',
                'nominal' => 8500000.00,
                'tanggal_ajuan' => now()->subDays(10)->toDateString(),
                'status' => DokumenPengeluaran::STATUS_DIARSIPKAN,
                'file_path' => [
                    ['judul' => 'Dokumen Tambahan Uang', 'file' => 'dokumen_pengeluaran/sample_tu.pdf'],
                ],
                'keterangan' => 'Pengajuan Tambahan Uang (TU) operasional penunjang',
            ]
        );

        if ($dok6->wasRecentlyCreated) {
            Verifikasi::create([
                'dokumen_id' => $dok6->id,
                'verifikator_id' => $verifikator->id,
                'hasil' => 'lolos',
                'tanggal_verifikasi' => now()->subDays(9),
                'catatan' => 'Lolos verifikasi.',
            ]);

            Pengesahan::create([
                'dokumen_id' => $dok6->id,
                'ppk_id' => $ppk->id,
                'tanggal_sah' => now()->subDays(8),
                'catatan' => 'Disahkan PPK.',
            ]);

            Pembayaran::create([
                'dokumen_id' => $dok6->id,
                'bendahara_id' => $bendahara->id,
                'tanggal_bayar' => now()->subDays(7),
                'nomor_spj' => 'BKU-2026/08/006',
                'status_bayar' => 'Lunas',
            ]);
        }

        // 7. Dokumen Bidang Keuangan (PPTK Keuangan)
        if ($pptkKeuangan) {
            $dok7 = DokumenPengeluaran::firstOrCreate(
                ['kode_dokumen' => 'BLUD-2026-08-0007'],
                [
                    'bidang_id' => $pptkKeuangan->bidang_id,
                    'pptk_id' => $pptkKeuangan->id,
                    'jenis_dokumen' => 'Belanja Jasa Konsultansi Akuntansi & Audit',
                    'sumber_dana' => 'BLUD',
                    'nominal' => 18500000.00,
                    'tanggal_ajuan' => now()->subDays(3)->toDateString(),
                    'status' => DokumenPengeluaran::STATUS_DIVERIFIKASI,
                    'file_path' => [
                        ['judul' => 'Kwitansi Jasa Audit KAP', 'file' => 'dokumen_pengeluaran/sample_kwitansi.pdf'],
                    ],
                    'keterangan' => 'Pembayaran jasa pendampingan laporan keuangan BLUD',
                ]
            );

            if ($dok7->wasRecentlyCreated) {
                Verifikasi::create([
                    'dokumen_id' => $dok7->id,
                    'verifikator_id' => $verifikator->id,
                    'hasil' => 'lolos',
                    'tanggal_verifikasi' => now()->subDays(2),
                    'catatan' => 'Berkas SPJ Keuangan lengkap.',
                ]);
            }

            $dok8 = DokumenPengeluaran::firstOrCreate(
                ['kode_dokumen' => 'BLUD-2026-08-0008'],
                [
                    'bidang_id' => $pptkKeuangan->bidang_id,
                    'pptk_id' => $pptkKeuangan->id,
                    'jenis_dokumen' => 'Belanja barang ATK, barang cetakan dll',
                    'sumber_dana' => 'BLUD',
                    'nominal' => 3200000.00,
                    'tanggal_ajuan' => now()->subDay()->toDateString(),
                    'status' => DokumenPengeluaran::STATUS_DIAJUKAN,
                    'file_path' => [
                        ['judul' => 'Nota Cetakan Buku Kas & Map SPJ', 'file' => 'dokumen_pengeluaran/sample_nota.pdf'],
                    ],
                    'keterangan' => 'Pengadaan map arsip BKU dan formulir verifikasi keuangan',
                ]
            );
        }

        // 8. Dokumen Bidang SDM & Keperawatan
        if ($pptkSdm) {
            DokumenPengeluaran::firstOrCreate(
                ['kode_dokumen' => 'BLUD-2026-08-0009'],
                [
                    'bidang_id' => $pptkSdm->bidang_id,
                    'pptk_id' => $pptkSdm->id,
                    'jenis_dokumen' => 'Belanja Diklat / Pelatihan SDM',
                    'sumber_dana' => 'BLUD',
                    'nominal' => 9600000.00,
                    'tanggal_ajuan' => now()->subDays(2)->toDateString(),
                    'status' => DokumenPengeluaran::STATUS_DIAJUKAN,
                    'file_path' => [
                        ['judul' => 'Surat Tugas & SPPD Pelatihan', 'file' => 'dokumen_pengeluaran/sample_sp.pdf'],
                    ],
                    'keterangan' => 'Biaya pelatihan akreditasi tenaga kesehatan RSJ',
                ]
            );
        }

        if ($pptkKeperawatan) {
            DokumenPengeluaran::firstOrCreate(
                ['kode_dokumen' => 'BLUD-2026-08-0010'],
                [
                    'bidang_id' => $pptkKeperawatan->bidang_id,
                    'pptk_id' => $pptkKeperawatan->id,
                    'jenis_dokumen' => 'Belanja perlengkapan medis keperawatan',
                    'sumber_dana' => 'BLUD',
                    'nominal' => 7400000.00,
                    'tanggal_ajuan' => now()->subDays(4)->toDateString(),
                    'status' => DokumenPengeluaran::STATUS_DIAJUKAN,
                    'file_path' => [
                        ['judul' => 'Nota Perlengkapan Ruang Rawat Inap', 'file' => 'dokumen_pengeluaran/sample_alkes.pdf'],
                    ],
                    'keterangan' => 'Pengadaan linen dan perlengkapan asuhan keperawatan',
                ]
            );
        }
    }
}
