<?php

namespace App\Filament\Resources\DokumenPengeluarans\Pages;

use App\Filament\Resources\DokumenPengeluarans\DokumenPengeluaranResource;
use App\Models\DokumenPengeluaran;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditDokumenPengeluaran extends EditRecord
{
    protected static string $resource = DokumenPengeluaranResource::class;

    protected ?string $previousStatus = null;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function beforeSave(): void
    {
        $this->previousStatus = $this->getRecord()->getOriginal('status') ?? $this->getRecord()->status;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('ajukan_draft')
                ->label('Ajukan ke Verifikator')
                ->icon('heroicon-o-paper-airplane')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Ajukan Dokumen Draft ke Verifikator')
                ->modalDescription('Pastikan seluruh data dan dokumen lampiran telah lengkap. Setelah diajukan, dokumen akan masuk ke antrean Verifikator.')
                ->modalSubmitActionLabel('Ya, Ajukan Sekarang')
                ->visible(fn () => auth()->user()?->hasAnyRole(['pptk', 'super_admin', 'admin']) && $this->getRecord()->status === DokumenPengeluaran::STATUS_DRAFT)
                ->action(function () {
                    $record = $this->getRecord();

                    if (! $record->hasValidLampiran()) {
                        Notification::make()
                            ->title('Lampiran Belum Lengkap')
                            ->body('Silakan unggah minimal 1 file PDF atau tautan Google Drive dan simpan perubahan sebelum mengajukan dokumen.')
                            ->danger()
                            ->send();

                        return;
                    }

                    $record->update(['status' => DokumenPengeluaran::STATUS_DIAJUKAN]);

                    $verifikators = User::role('verifikator')->get();
                    if ($verifikators->isNotEmpty()) {
                        Notification::make()
                            ->title('Dokumen Baru Diajukan')
                            ->body('Dokumen '.$record->kode_dokumen.' telah diajukan oleh PPTK ('.auth()->user()->name.') dan menunggu verifikasi.')
                            ->success()
                            ->sendToDatabase($verifikators);
                    }

                    Notification::make()
                        ->title('Dokumen Berhasil Diajukan')
                        ->body('Dokumen '.$record->kode_dokumen.' telah dikirimkan ke Verifikator.')
                        ->success()
                        ->send();

                    $this->redirect($this->getResource()::getUrl('index'));
                }),
            Action::make('kirim_ulang')
                ->label('Ajukan Ulang ke Verifikator')
                ->icon('heroicon-o-paper-airplane')
                ->color('primary')
                ->modalHeading('Ajukan Ulang Dokumen ke Verifikator')
                ->modalDescription('Dokumen yang telah diperbaiki ini akan dikirimkan kembali ke Verifikator untuk diperiksa.')
                ->visible(fn () => auth()->user()?->hasRole('pptk') && $this->getRecord()->status === DokumenPengeluaran::STATUS_DIKEMBALIKAN)
                ->action(function () {
                    $record = $this->getRecord();
                    $record->update(['status' => DokumenPengeluaran::STATUS_DIAJUKAN]);

                    $verifikators = User::role('verifikator')->get();
                    if ($verifikators->isNotEmpty()) {
                        Notification::make()
                            ->title('Dokumen Diajukan Ulang')
                            ->body('Dokumen '.$record->kode_dokumen.' telah diperbaiki oleh PPTK ('.auth()->user()->name.') dan diajukan ulang untuk verifikasi.')
                            ->info()
                            ->sendToDatabase($verifikators);
                    }

                    Notification::make()
                        ->title('Dokumen Berhasil Diajukan Ulang')
                        ->body('Dokumen '.$record->kode_dokumen.' telah dikirimkan ke Verifikator.')
                        ->success()
                        ->send();

                    $this->redirect($this->getResource()::getUrl('index'));
                }),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $record = $this->getRecord();

        if (auth()->user()?->hasRole('pptk') && $this->previousStatus === DokumenPengeluaran::STATUS_DRAFT && $record->status === DokumenPengeluaran::STATUS_DIAJUKAN) {
            $verifikators = User::role('verifikator')->get();
            if ($verifikators->isNotEmpty()) {
                Notification::make()
                    ->title('Dokumen Baru Diajukan')
                    ->body('Dokumen '.$record->kode_dokumen.' telah diajukan oleh PPTK ('.auth()->user()->name.') dan menunggu verifikasi.')
                    ->success()
                    ->sendToDatabase($verifikators);
            }

            Notification::make()
                ->title('Draft Disimpan & Diajukan')
                ->body('Dokumen '.$record->kode_dokumen.' berhasil diajukan ke Verifikator.')
                ->success()
                ->send();

            return;
        }

        if (auth()->user()?->hasRole('pptk') && $record->status === DokumenPengeluaran::STATUS_DIKEMBALIKAN) {
            $record->update(['status' => DokumenPengeluaran::STATUS_DIAJUKAN]);

            $verifikators = User::role('verifikator')->get();
            if ($verifikators->isNotEmpty()) {
                Notification::make()
                    ->title('Dokumen Diajukan Ulang')
                    ->body('Dokumen '.$record->kode_dokumen.' telah diperbaiki oleh PPTK ('.auth()->user()->name.') dan diajukan ulang untuk verifikasi.')
                    ->info()
                    ->sendToDatabase($verifikators);
            }

            Notification::make()
                ->title('Perbaikan Disimpan & Diajukan Ulang')
                ->body('Dokumen '.$record->kode_dokumen.' berhasil diperbaiki dan diajukan kembali ke Verifikator.')
                ->success()
                ->send();
        }
    }
}
