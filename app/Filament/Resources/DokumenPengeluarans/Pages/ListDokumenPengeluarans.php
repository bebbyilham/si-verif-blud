<?php

namespace App\Filament\Resources\DokumenPengeluarans\Pages;

use App\Filament\Resources\DokumenPengeluarans\DokumenPengeluaranResource;
use App\Models\DokumenPengeluaran;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
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
                ->modalHeading('Buat Dokumen Pengeluaran')
                ->modalDescription('Pilih mode penyimpanan: Anda dapat langsung mengajukan dokumen ke Verifikator atau menyimpannya terlebih dahulu sebagai Draft.')
                ->visible(fn () => auth()->user()->hasAnyRole(['pptk', 'super_admin', 'admin']))
                ->successNotification(function (DokumenPengeluaran $record): Notification {
                    if ($record->status === DokumenPengeluaran::STATUS_DRAFT) {
                        return Notification::make()
                            ->warning()
                            ->title('Dokumen Disimpan sebagai Draft')
                            ->body('Dokumen '.$record->kode_dokumen.' berhasil disimpan ke Draft. Dokumen belum diajukan ke Verifikator dan dapat diakses pada tab Draft.');
                    }

                    return Notification::make()
                        ->success()
                        ->title('Dokumen Berhasil Diajukan ke Verifikator')
                        ->body('Dokumen '.$record->kode_dokumen.' telah berhasil diajukan dan masuk ke antrean Verifikator.');
                }),
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
