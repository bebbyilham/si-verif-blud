<?php

namespace App\Filament\Widgets;

use App\Models\DokumenPengeluaran;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class DokumenChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Pengajuan Dokumen';

    protected static ?int $sort = 3;

    public function getHeading(): ?string
    {
        $user = auth()->user();
        if ($user && $user->hasRole('pptk') && $user->bidang) {
            return 'Pengajuan Dokumen Bidang '.$user->bidang->nama_bidang;
        }

        return $this->heading;
    }

    public static function canView(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'super_admin', 'manajemen', 'pptk', 'verifikator']);
    }

    protected function getData(): array
    {
        $days = [];
        $counts = [];

        $user = auth()->user();
        $baseQuery = DokumenPengeluaran::query()
            ->where('status', '!=', DokumenPengeluaran::STATUS_DRAFT);

        if ($user && $user->hasRole('pptk')) {
            $baseQuery->where('pptk_id', $user->id);
        }

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
                $counts[] = (clone $baseQuery)
                    ->whereYear('tanggal_ajuan', $date->year)
                    ->whereMonth('tanggal_ajuan', $date->month)
                    ->count();
            }
        } else {
            $period = CarbonPeriod::create($start, $end);
            foreach ($period as $date) {
                $days[] = $date->format('d M');
                $counts[] = (clone $baseQuery)
                    ->whereDate('tanggal_ajuan', $date->toDateString())
                    ->count();
            }
        }

        return [
            'datasets' => [
                [
                    'label' => $user && $user->hasRole('pptk') ? 'Dokumen Saya' : 'Total Dokumen Diajukan',
                    'data' => $counts,
                    'borderColor' => '#6366f1',
                    'fill' => true,
                    'backgroundColor' => 'rgba(99, 102, 241, 0.1)',
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
