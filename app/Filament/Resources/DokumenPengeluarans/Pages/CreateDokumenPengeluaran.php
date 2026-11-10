<?php

namespace App\Filament\Resources\DokumenPengeluarans\Pages;

use App\Filament\Resources\DokumenPengeluarans\DokumenPengeluaranResource;
use App\Models\DokumenPengeluaran;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateDokumenPengeluaran extends CreateRecord
{
    protected static string $resource = DokumenPengeluaranResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        $record = $this->getRecord();

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
    }
}
