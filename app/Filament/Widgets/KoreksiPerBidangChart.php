<?php

namespace App\Filament\Widgets;

use App\Models\Bidang;
use App\Models\DokumenPengeluaran;
use App\Models\RiwayatKoreksi;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class KoreksiPerBidangChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Tingkat Koreksi Dokumen per Bidang';

    protected static ?int $sort = 4;

    public static function canView(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'super_admin', 'manajemen']);
    }

    protected function getData(): array
    {
        $bidangs = Bidang::all();
        $labels = [];
        $counts = [];

        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        foreach ($bidangs as $bidang) {
            $labels[] = $bidang->nama_bidang;
            $counts[] = RiwayatKoreksi::whereHas('dokumenPengeluaran', function ($q) use ($bidang, $startDate, $endDate) {
                $q->where('bidang_id', $bidang->id)
                    ->where('status', '!=', DokumenPengeluaran::STATUS_DRAFT);

                if ($startDate) {
                    $q->whereDate('tanggal_ajuan', '>=', $startDate);
                }

                if ($endDate) {
                    $q->whereDate('tanggal_ajuan', '<=', $endDate);
                }
            })->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Koreksi',
                    'data' => $counts,
                    'backgroundColor' => [
                        '#ef4444', '#f97316', '#eab308',
                        '#22c55e', '#3b82f6', '#8b5cf6',
                    ],
                    'borderRadius' => 5,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
