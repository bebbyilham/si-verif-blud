<?php

namespace App\Filament\Widgets;

use App\Models\DokumenPengeluaran;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected function getColumns(): int
    {
        $user = auth()->user();

        if ($user && $user->hasRole('pptk')) {
            return 4;
        }

        return 3;
    }

    private function queryWithFilter(bool $excludeDraft = true)
    {
        $query = DokumenPengeluaran::query();

        if ($excludeDraft) {
            $query->where('status', '!=', DokumenPengeluaran::STATUS_DRAFT);
        }

        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        if ($startDate) {
            $query->whereDate('tanggal_ajuan', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('tanggal_ajuan', '<=', $endDate);
        }

        return $query;
    }

    protected function getStats(): array
    {
        $user = auth()->user();

        if ($user->hasAnyRole(['admin', 'super_admin', 'manajemen'])) {
            return $this->getAdminStats();
        }

        if ($user->hasRole('pptk')) {
            return $this->getPptkStats();
        }

        if ($user->hasRole('verifikator')) {
            return $this->getVerifikatorStats();
        }

        if ($user->hasRole('ppk')) {
            return $this->getPpkStats();
        }

        if ($user->hasRole('bendahara')) {
            return $this->getBendaharaStats();
        }

        return [];
    }

    private function getAdminStats(): array
    {
        $baseQuery = $this->queryWithFilter();
        $dibayar = (clone $baseQuery)->where('status', DokumenPengeluaran::STATUS_DIBAYAR)->count();
        $diarsipkan = (clone $baseQuery)->where('status', DokumenPengeluaran::STATUS_DIARSIPKAN)->count();

        return [
            Stat::make('Total Dokumen', (clone $baseQuery)->count())
                ->description('Semua dokumen yang diajukan')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
            Stat::make('Menunggu Verifikasi', (clone $baseQuery)->where('status', DokumenPengeluaran::STATUS_DIAJUKAN)->count())
                ->description('Menunggu pemeriksaan Verifikator')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            Stat::make('Dikembalikan (Revisi)', (clone $baseQuery)->where('status', DokumenPengeluaran::STATUS_DIKEMBALIKAN)->count())
                ->description('Perlu revisi oleh PPTK')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
            Stat::make('Menunggu Pengesahan', (clone $baseQuery)->where('status', DokumenPengeluaran::STATUS_DIVERIFIKASI)->count())
                ->description('Lolos verifikasi, menunggu PPK')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('info'),
            Stat::make('Menunggu Pembayaran', (clone $baseQuery)->where('status', DokumenPengeluaran::STATUS_DISAHKAN)->count())
                ->description('Telah disahkan PPK, siap bayar')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
            Stat::make('Selesai (Dibayar & Arsip)', $dibayar + $diarsipkan)
                ->description("{$dibayar} Dibayar • {$diarsipkan} Diarsipkan")
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }

    private function getPptkStats(): array
    {
        $user = auth()->user();
        $myDocs = $this->queryWithFilter(excludeDraft: true)->where('pptk_id', $user->id);
        $draftCount = $this->queryWithFilter(excludeDraft: false)
            ->where('pptk_id', $user->id)
            ->where('status', DokumenPengeluaran::STATUS_DRAFT)
            ->count();

        $diajukan = (clone $myDocs)->where('status', DokumenPengeluaran::STATUS_DIAJUKAN)->count();
        $diverifikasi = (clone $myDocs)->where('status', DokumenPengeluaran::STATUS_DIVERIFIKASI)->count();
        $disahkan = (clone $myDocs)->where('status', DokumenPengeluaran::STATUS_DISAHKAN)->count();
        $sedangDiproses = $diajukan + $diverifikasi + $disahkan;

        $dikembalikan = (clone $myDocs)->where('status', DokumenPengeluaran::STATUS_DIKEMBALIKAN)->count();
        $selesaiQuery = (clone $myDocs)->whereIn('status', [
            DokumenPengeluaran::STATUS_DIBAYAR,
            DokumenPengeluaran::STATUS_DIARSIPKAN,
        ]);
        $selesaiCount = (clone $selesaiQuery)->count();
        $selesaiNominal = (float) (clone $selesaiQuery)->sum('nominal');

        $namaBidang = $user->bidang?->nama_bidang ?? 'PPTK';
        $totalDesc = $draftCount > 0
            ? "Bidang {$namaBidang} (+{$draftCount} Draft belum diajukan)"
            : "Total dokumen diajukan Bidang {$namaBidang}";

        return [
            Stat::make('Dokumen Saya', (clone $myDocs)->count())
                ->description($totalDesc)
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
            Stat::make('Sedang Diproses', $sedangDiproses)
                ->description("{$diajukan} Diajukan • {$diverifikasi} Diverifikasi • {$disahkan} Disahkan")
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            Stat::make('Dikembalikan', $dikembalikan)
                ->description('Perlu revisi / perbaikan berkas')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
            Stat::make('Selesai Dicairkan', $selesaiCount)
                ->description('Realisasi: Rp '.number_format($selesaiNominal, 0, ',', '.'))
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }

    private function getVerifikatorStats(): array
    {
        $baseQuery = $this->queryWithFilter();

        return [
            Stat::make('Antrean Verifikasi', (clone $baseQuery)->where('status', DokumenPengeluaran::STATUS_DIAJUKAN)->count())
                ->description('Dokumen menunggu pemeriksaan')
                ->descriptionIcon('heroicon-m-queue-list')
                ->color('warning'),
            Stat::make('Dalam Revisi PPTK', (clone $baseQuery)->where('status', DokumenPengeluaran::STATUS_DIKEMBALIKAN)->count())
                ->description('Dikembalikan & menunggu perbaikan')
                ->descriptionIcon('heroicon-m-arrow-uturn-left')
                ->color('danger'),
            Stat::make('Telah Lolos Verifikasi', (clone $baseQuery)->whereIn('status', [
                DokumenPengeluaran::STATUS_DIVERIFIKASI,
                DokumenPengeluaran::STATUS_DISAHKAN,
                DokumenPengeluaran::STATUS_DIBAYAR,
                DokumenPengeluaran::STATUS_DIARSIPKAN,
            ])->count())
                ->description('Total dokumen lolos verifikasi')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }

    private function getPpkStats(): array
    {
        $baseQuery = $this->queryWithFilter();
        $disahkanQuery = (clone $baseQuery)->whereIn('status', [
            DokumenPengeluaran::STATUS_DISAHKAN,
            DokumenPengeluaran::STATUS_DIBAYAR,
            DokumenPengeluaran::STATUS_DIARSIPKAN,
        ]);

        return [
            Stat::make('Menunggu Pengesahan', (clone $baseQuery)->where('status', DokumenPengeluaran::STATUS_DIVERIFIKASI)->count())
                ->description('Perlu pengesahan PPK')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('warning'),
            Stat::make('Telah Disahkan PPK', (clone $disahkanQuery)->count())
                ->description('Total dokumen yang telah disahkan')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
            Stat::make('Nilai Dokumen Disahkan', 'Rp '.number_format((float) (clone $disahkanQuery)->sum('nominal'), 0, ',', '.'))
                ->description('Total nominal yang telah disahkan')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info'),
        ];
    }

    private function getBendaharaStats(): array
    {
        $baseQuery = $this->queryWithFilter();
        $realisasiQuery = (clone $baseQuery)->whereIn('status', [
            DokumenPengeluaran::STATUS_DIBAYAR,
            DokumenPengeluaran::STATUS_DIARSIPKAN,
        ]);

        return [
            Stat::make('Menunggu Pembayaran', (clone $baseQuery)->where('status', DokumenPengeluaran::STATUS_DISAHKAN)->count())
                ->description('Siap diproses pencairan & BKU')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning'),
            Stat::make('Menunggu Arsip', (clone $baseQuery)->where('status', DokumenPengeluaran::STATUS_DIBAYAR)->count())
                ->description('Sudah dibayar, belum diarsipkan')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('info'),
            Stat::make('Total Terealisasi', (clone $realisasiQuery)->count())
                ->description('Rp '.number_format((float) (clone $realisasiQuery)->sum('nominal'), 0, ',', '.'))
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }
}
