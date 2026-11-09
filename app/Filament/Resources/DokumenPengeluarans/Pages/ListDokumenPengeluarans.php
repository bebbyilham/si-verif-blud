<?php

namespace App\Filament\Resources\DokumenPengeluarans\Pages;

use App\Filament\Resources\DokumenPengeluarans\DokumenPengeluaranResource;
use App\Models\DokumenPengeluaran;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListDokumenPengeluarans extends ListRecords
{
    protected static string $resource = DokumenPengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Ajukan / Buat Dokumen')
                ->visible(fn () => auth()->user()->hasAnyRole(['pptk', 'super_admin', 'admin'])),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        $user = auth()->user();

        if ($user->hasRole('verifikator')) {
            return 'diajukan';
        }

        if ($user->hasRole('ppk')) {
            return 'diverifikasi';
        }

        if ($user->hasRole('bendahara')) {
            return 'disahkan';
        }

        return 'semua';
    }

    public function getTabs(): array
    {
        $baseQuery = fn () => DokumenPengeluaranResource::getEloquentQuery();

        $tabs = [
            'semua' => Tab::make('Semua')
                ->badge($baseQuery()->count()),
        ];

        if (auth()->user()?->hasAnyRole(['pptk', 'admin', 'super_admin'])) {
            $tabs['draft'] = Tab::make('Draft')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', DokumenPengeluaran::STATUS_DRAFT))
                ->badge($baseQuery()->where('status', DokumenPengeluaran::STATUS_DRAFT)->count())
                ->badgeColor('gray');
        }

        return array_merge($tabs, [
            'diajukan' => Tab::make('Diajukan')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', DokumenPengeluaran::STATUS_DIAJUKAN))
                ->badge($baseQuery()->where('status', DokumenPengeluaran::STATUS_DIAJUKAN)->count())
                ->badgeColor('warning'),
            'dikembalikan' => Tab::make('Dikembalikan')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', DokumenPengeluaran::STATUS_DIKEMBALIKAN))
                ->badge($baseQuery()->where('status', DokumenPengeluaran::STATUS_DIKEMBALIKAN)->count())
                ->badgeColor('danger'),
            'diverifikasi' => Tab::make('Diverifikasi')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', DokumenPengeluaran::STATUS_DIVERIFIKASI))
                ->badge($baseQuery()->where('status', DokumenPengeluaran::STATUS_DIVERIFIKASI)->count())
                ->badgeColor('info'),
            'disahkan' => Tab::make('Disahkan')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', DokumenPengeluaran::STATUS_DISAHKAN))
                ->badge($baseQuery()->where('status', DokumenPengeluaran::STATUS_DISAHKAN)->count())
                ->badgeColor('success'),
            'dibayar' => Tab::make('Dibayar')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', DokumenPengeluaran::STATUS_DIBAYAR))
                ->badge($baseQuery()->where('status', DokumenPengeluaran::STATUS_DIBAYAR)->count())
                ->badgeColor('success'),
            'diarsipkan' => Tab::make('Diarsipkan')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', DokumenPengeluaran::STATUS_DIARSIPKAN))
                ->badge($baseQuery()->where('status', DokumenPengeluaran::STATUS_DIARSIPKAN)->count())
                ->badgeColor('gray'),
        ]);
    }
}
