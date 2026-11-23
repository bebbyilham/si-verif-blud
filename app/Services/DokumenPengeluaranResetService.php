<?php

namespace App\Services;

use App\Models\AuditTrail;
use App\Models\DokumenPengeluaran;
use App\Models\Pembayaran;
use App\Models\Pengesahan;
use App\Models\RiwayatKoreksi;
use App\Models\Verifikasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class DokumenPengeluaranResetService
{
    /**
     * Menghitung ringkasan jumlah data transaksi dokumen pengeluaran saat ini.
     *
     * @return array<string, int>
     */
    public function getSummary(): array
    {
        return [
            'dokumen' => DokumenPengeluaran::count(),
            'verifikasi' => Verifikasi::count(),
            'koreksi' => RiwayatKoreksi::count(),
            'pengesahan' => Pengesahan::count(),
            'pembayaran' => Pembayaran::count(),
        ];
    }

    /**
     * Mereset seluruh data transaksi Dokumen Pengeluaran beserta tabel anaknya
     * tanpa menyentuh Data Master dan tetap mencatat jejak audit permanen.
     *
     * @return array<string, int>
     */
    public function reset(
        string $alasan,
        bool $hapusLampiranFisik = true,
        bool $hapusNotifikasiTerkait = true,
        ?int $userId = null,
        ?string $ipAddress = null,
    ): array {
        $summary = $this->getSummary();
        $localFiles = $hapusLampiranFisik ? $this->collectLocalAttachmentPaths() : [];

        DB::transaction(function (): void {
            Pembayaran::query()->delete();
            Pengesahan::query()->delete();
            RiwayatKoreksi::query()->delete();
            Verifikasi::query()->delete();
            DokumenPengeluaran::query()->delete();
        });

        $this->resetAutoIncrement();

        $deletedFiles = 0;
        if ($hapusLampiranFisik && ! empty($localFiles)) {
            $disk = Storage::disk('public');
            foreach ($localFiles as $path) {
                if ($disk->exists($path) && $disk->delete($path)) {
                    $deletedFiles++;
                }
            }
        }

        $deletedNotifications = 0;
        if ($hapusNotifikasiTerkait && Schema::hasTable('notifications')) {
            $deletedNotifications = DB::table('notifications')
                ->where(function ($query): void {
                    $query->where('data', 'like', '%Dokumen%')
                        ->orWhere('data', 'like', '%BLUD-%');
                })
                ->delete();
        }

        $cleanAlasan = trim(preg_replace('/\s+/', ' ', $alasan) ?? '');
        $auditAksi = mb_substr(
            'Reset Data: '.$summary['dokumen'].' dok dihapus (Alasan: '.$cleanAlasan.')',
            0,
            100
        );

        AuditTrail::create([
            'user_id' => $userId ?? auth()->id(),
            'aksi' => $auditAksi,
            'tabel_terdampak' => 'dokumen_pengeluarans',
            'id_data_terdampak' => 0,
            'waktu' => now(),
            'ip_address' => $ipAddress ?? request()?->ip(),
        ]);

        return [
            'deleted_dokumen' => $summary['dokumen'],
            'deleted_verifikasi' => $summary['verifikasi'],
            'deleted_koreksi' => $summary['koreksi'],
            'deleted_pengesahan' => $summary['pengesahan'],
            'deleted_pembayaran' => $summary['pembayaran'],
            'deleted_files' => $deletedFiles,
            'deleted_notifications' => $deletedNotifications,
        ];
    }

    /**
     * Mengumpulkan path lampiran PDF lokal pada disk public (mengabaikan tautan URL Google Drive).
     *
     * @return array<int, string>
     */
    protected function collectLocalAttachmentPaths(): array
    {
        $paths = [];

        DokumenPengeluaran::query()
            ->select(['id', 'file_path'])
            ->chunkById(200, function ($records) use (&$paths): void {
                foreach ($records as $record) {
                    $files = $record->file_path;
                    if (is_string($files)) {
                        $files = json_decode($files, true) ?? [];
                    }

                    foreach ((array) $files as $item) {
                        $filePath = is_array($item) ? ($item['file'] ?? null) : (is_string($item) ? $item : null);
                        $tipeSumber = is_array($item) ? ($item['tipe_sumber'] ?? null) : null;

                        if (
                            blank($filePath) ||
                            $tipeSumber === 'link' ||
                            str_starts_with($filePath, 'http://') ||
                            str_starts_with($filePath, 'https://') ||
                            str_contains($filePath, '..')
                        ) {
                            continue;
                        }

                        $paths[] = ltrim($filePath, '/');
                    }
                }
            });

        return array_values(array_unique($paths));
    }

    /**
     * Mereset auto-increment tabel transaksi lintas driver database (MySQL/MariaDB & SQLite).
     */
    protected function resetAutoIncrement(): void
    {
        $tables = [
            'pembayarans',
            'pengesahans',
            'riwayat_koreksis',
            'verifikasis',
            'dokumen_pengeluarans',
        ];

        $driver = DB::getDriverName();

        try {
            if (in_array($driver, ['mysql', 'mariadb'], true)) {
                foreach ($tables as $table) {
                    DB::statement("ALTER TABLE `{$table}` AUTO_INCREMENT = 1");
                }
            } elseif ($driver === 'sqlite') {
                $placeholders = implode(', ', array_fill(0, count($tables), '?'));
                DB::delete("DELETE FROM sqlite_sequence WHERE name IN ({$placeholders})", $tables);
            }
        } catch (\Throwable $e) {
            Log::warning('Gagal mereset auto-increment saat reset Dokumen Pengeluaran: '.$e->getMessage());
        }
    }
}
