<?php

namespace App\Filament\Widgets;

use App\Models\Verifikasi;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class WaktuVerifikasiChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Rata-Rata Waktu Verifikasi (Hari)';

    protected static ?int $sort = 5;

    public static function canView(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'super_admin', 'manajemen', 'verifikator']);
    }

    protected function getData(): array
    {
        $days = [];
        $averages = [];

        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        if ($startDate) {
            $start = Carbon::parse($startDate);
        } else {
            $minDate = Verifikasi::min('tanggal_verifikasi');
            $parsedMin = $minDate ? Carbon::parse($minDate)->startOfDay() : now()->subDays(6);
            $start = $parsedMin->lt(now()->subDays(6)) ? $parsedMin : now()->subDays(6);
        }

        $end = $endDate ? Carbon::parse($endDate) : now();
        if ($start->gt($end)) {
            $start = $end->copy()->subDays(6);
        }

        $period = CarbonPeriod::create($start, $end);

        foreach ($period as $date) {
            $days[] = $date->format('d M');

            // Hitung rata-rata waktu antara tanggal_ajuan dan tanggal_verifikasi
            $verifikasis = Verifikasi::whereDate('tanggal_verifikasi', $date->toDateString())
                ->with('dokumenPengeluaran')
                ->get();

            if ($verifikasis->isEmpty()) {
                $averages[] = 0;
            } else {
                $totalDays = 0;
                $count = 0;
                foreach ($verifikasis as $v) {
                    if ($v->dokumenPengeluaran && $v->dokumenPengeluaran->tanggal_ajuan) {
                        $ajuan = Carbon::parse($v->dokumenPengeluaran->tanggal_ajuan)->startOfDay();
                        $verif = Carbon::parse($v->tanggal_verifikasi)->startOfDay();
                        $totalDays += abs($verif->diffInDays($ajuan));
                        $count++;
                    }
                }
                $averages[] = $count > 0 ? round($totalDays / $count, 1) : 0;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Rata-rata (hari)',
                    'data' => $averages,
                    'borderColor' => '#10b981',
                    'fill' => true,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'tension' => 0.4,
                ],
            ],
            'labels' => $days,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
