<?php

namespace App\Filament\Widgets;

use App\Models\DokumenPengeluaran;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class PengeluaranChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Total Pengeluaran';

    protected static ?int $sort = 2;

    public static function canView(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'super_admin', 'manajemen', 'bendahara']);
    }

    protected function getData(): array
    {
        $days = [];
        $sums = [];

        $baseQuery = DokumenPengeluaran::query()
            ->whereIn('status', [
                DokumenPengeluaran::STATUS_DISAHKAN,
                DokumenPengeluaran::STATUS_DIBAYAR,
                DokumenPengeluaran::STATUS_DIARSIPKAN,
            ]);

        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        if ($startDate) {
            $start = Carbon::parse($startDate);
        } else {
            $minDate = (clone $baseQuery)->min('tanggal_ajuan');
            $parsedMin = $minDate ? Carbon::parse($minDate) : now()->subDays(6);
            $start = $parsedMin->lt(now()->subDays(6)) ? $parsedMin : now()->subDays(6);
        }

        $end = $endDate ? Carbon::parse($endDate) : now();
        if ($start->gt($end)) {
            $start = $end->copy()->subDays(6);
        }

        $diffInDays = $start->diffInDays($end);

        if ($diffInDays > 90) {
            $period = CarbonPeriod::create($start->copy()->startOfMonth(), '1 month', $end->copy()->endOfMonth());
            foreach ($period as $date) {
                $days[] = $date->format('M Y');
                $sums[] = (clone $baseQuery)
                    ->whereYear('tanggal_ajuan', $date->year)
                    ->whereMonth('tanggal_ajuan', $date->month)
                    ->sum('nominal') / 1000000;
            }
        } else {
            $period = CarbonPeriod::create($start, $end);
            foreach ($period as $date) {
                $days[] = $date->format('d M');
                $sums[] = (clone $baseQuery)
                    ->whereDate('tanggal_ajuan', $date->toDateString())
                    ->sum('nominal') / 1000000;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengeluaran Sah (Jutaan)',
                    'data' => $sums,
                    'backgroundColor' => '#6366f1',
                    'borderRadius' => 5,
                ],
            ],
            'labels' => $days,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
