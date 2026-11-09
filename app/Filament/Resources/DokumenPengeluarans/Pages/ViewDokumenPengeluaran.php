<?php

namespace App\Filament\Resources\DokumenPengeluarans\Pages;

use App\Filament\Resources\DokumenPengeluarans\DokumenPengeluaranResource;
use App\Filament\Resources\DokumenPengeluarans\Tables\DokumenPengeluaransTable;
use App\Models\DokumenPengeluaran;
use App\Models\JenisKesalahan;
use App\Models\Pembayaran;
use App\Models\Pengesahan;
use App\Models\RiwayatKoreksi;
use App\Models\User;
use App\Models\Verifikasi;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewDokumenPengeluaran extends ViewRecord
{
    protected static string $resource = DokumenPengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // === LIHAT LAMPIRAN ===
            Action::make('lihat_lampiran')
                ->label('Lampiran')
                ->icon('heroicon-o-paper-clip')
                ->color('info')
                ->modalHeading(fn () => 'Daftar Dokumen Lampiran - '.$this->getRecord()->kode_dokumen)
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Tutup')
                ->modalContent(fn () => DokumenPengeluaransTable::renderLampiranModal($this->getRecord())),

            // === AKSI PPTK / ADMIN: AJUKAN DOKUMEN DRAFT ===
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
                            ->body('Silakan klik tombol Ubah dan unggah minimal 1 file PDF atau tautan Google Drive sebelum mengajukan dokumen.')
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
                }),

            // === AKSI PPTK: AJUKAN ULANG DOKUMEN REVISI ===
            Action::make('kirim_ulang')
                ->label('Ajukan Ulang')
                ->icon('heroicon-o-paper-airplane')
                ->color('primary')
                ->modalHeading('Ajukan Ulang Dokumen ke Verifikator')
                ->modalDescription('Dokumen yang telah Anda lengkapi / perbaiki akan dikirimkan kembali ke Verifikator untuk diperiksa ulang.')
                ->modalSubmitActionLabel('Kirim Ulang ke Verifikator')
                ->visible(fn () => auth()->user()?->hasRole('pptk') && $this->getRecord()->status === DokumenPengeluaran::STATUS_DIKEMBALIKAN)
                ->form([
                    Textarea::make('catatan_perbaikan')
                        ->label('Catatan Perbaikan / Kelengkapan (Opsional)')
                        ->placeholder('Jelaskan bagian data atau lampiran yang telah Anda perbaiki...'),
                ])
                ->action(function (array $data) {
                    $record = $this->getRecord();
                    $record->update(['status' => DokumenPengeluaran::STATUS_DIAJUKAN]);

                    // Notifikasi ke Verifikator
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
                        ->body('Dokumen '.$record->kode_dokumen.' telah dikirimkan ke Verifikator untuk diperiksa kembali.')
                        ->success()
                        ->send();
                }),

            // === AKSI VERIFIKATOR: VERIFIKASI LOLOS ===
            Action::make('verifikasi_lolos')
                ->label('Verifikasi Lolos')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->modalHeading('Konfirmasi Verifikasi Dokumen')
                ->modalDescription('Dokumen yang lolos verifikasi akan diteruskan ke PPK untuk pengesahan.')
                ->modalSubmitActionLabel('Setujui & Verifikasi')
                ->visible(fn () => auth()->user()?->hasRole('verifikator') && in_array($this->getRecord()->status, [DokumenPengeluaran::STATUS_DIAJUKAN, DokumenPengeluaran::STATUS_DIKEMBALIKAN]))
                ->form([
                    Textarea::make('catatan')
                        ->label('Catatan Verifikasi (Opsional)')
                        ->placeholder('Masukkan catatan verifikasi jika ada...'),
                ])
                ->action(function (array $data) {
                    $record = $this->getRecord();

                    Verifikasi::create([
                        'dokumen_id' => $record->id,
                        'verifikator_id' => auth()->id(),
                        'hasil' => 'lolos',
                        'tanggal_verifikasi' => now(),
                        'catatan' => $data['catatan'] ?? 'Lolos Verifikasi',
                    ]);

                    $record->update(['status' => DokumenPengeluaran::STATUS_DIVERIFIKASI]);

                    Notification::make()
                        ->title('Dokumen Diverifikasi')
                        ->body('Dokumen '.$record->kode_dokumen.' telah lolos verifikasi dan menunggu pengesahan PPK.')
                        ->success()
                        ->sendToDatabase($record->pptk);

                    $ppkUsers = User::role('ppk')->get();
                    if ($ppkUsers->isNotEmpty()) {
                        Notification::make()
                            ->title('Dokumen Menunggu Pengesahan')
                            ->body('Dokumen '.$record->kode_dokumen.' telah diverifikasi dan menunggu pengesahan Anda.')
                            ->info()
                            ->sendToDatabase($ppkUsers);
                    }

                    Notification::make()
                        ->title('Berhasil Diverifikasi')
                        ->body('Dokumen '.$record->kode_dokumen.' berhasil diverifikasi.')
                        ->success()
                        ->send();
                }),

            // === AKSI KEMBALIKAN / REVISI KE PPTK ===
            Action::make('verifikasi_kembalikan')
                ->label('Kembalikan (Revisi)')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->modalHeading('Kembalikan Dokumen ke PPTK (Revisi)')
                ->modalDescription('Dokumen akan dikembalikan ke PPTK beserta catatan jenis kesalahan untuk diperbaiki.')
                ->modalSubmitActionLabel('Kembalikan Dokumen')
                ->visible(function (): bool {
                    $user = auth()->user();
                    $record = $this->getRecord();
                    if (! $user || ! $record) {
                        return false;
                    }

                    if ($user->hasAnyRole(['super_admin', 'admin'])) {
                        return in_array($record->status, [
                            DokumenPengeluaran::STATUS_DIAJUKAN,
                            DokumenPengeluaran::STATUS_DIVERIFIKASI,
                            DokumenPengeluaran::STATUS_DISAHKAN,
                            DokumenPengeluaran::STATUS_DIBAYAR,
                        ]);
                    }

                    if ($user->hasRole('verifikator') && in_array($record->status, [
                        DokumenPengeluaran::STATUS_DIAJUKAN,
                        DokumenPengeluaran::STATUS_DIVERIFIKASI,
                    ])) {
                        return true;
                    }

                    if ($user->hasRole('ppk') && in_array($record->status, [
                        DokumenPengeluaran::STATUS_DIVERIFIKASI,
                        DokumenPengeluaran::STATUS_DISAHKAN,
                    ])) {
                        return true;
                    }

                    if ($user->hasRole('bendahara') && $record->status === DokumenPengeluaran::STATUS_DISAHKAN) {
                        return true;
                    }

                    return false;
                })
                ->form([
                    Select::make('jenis_kesalahan_id')
                        ->label('Kategori Jenis Kesalahan')
                        ->options(JenisKesalahan::pluck('nama_kesalahan', 'id'))
                        ->searchable()
                        ->required(),
                    Textarea::make('catatan')
                        ->label('Catatan Revisi / Alasan Pengembalian')
                        ->placeholder('Jelaskan detail bagian dokumen yang perlu diperbaiki oleh PPTK...')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $record = $this->getRecord();
                    $previousStatus = $record->status;

                    Verifikasi::create([
                        'dokumen_id' => $record->id,
                        'verifikator_id' => auth()->id(),
                        'hasil' => 'dikembalikan',
                        'tanggal_verifikasi' => now(),
                        'catatan' => $data['catatan'],
                    ]);

                    RiwayatKoreksi::create([
                        'dokumen_id' => $record->id,
                        'versi_ke' => $record->riwayatKoreksis()->count() + 1,
                        'jenis_kesalahan_id' => $data['jenis_kesalahan_id'] ?? null,
                        'catatan_koreksi' => $data['catatan'],
                        'tanggal_koreksi' => now(),
                        'dikoreksi_oleh' => auth()->id(),
                    ]);

                    $record->update(['status' => DokumenPengeluaran::STATUS_DIKEMBALIKAN]);

                    Notification::make()
                        ->title('Dokumen Dikembalikan')
                        ->body('Dokumen '.$record->kode_dokumen.' dikembalikan dari status '.strtoupper($previousStatus).' untuk direvisi. Alasan: '.($data['catatan'] ?? '-'))
                        ->danger()
                        ->sendToDatabase($record->pptk);

                    Notification::make()
                        ->title('Dokumen Dikembalikan ke PPTK')
                        ->body('Catatan revisi telah dikirimkan ke PPTK.')
                        ->warning()
                        ->send();
                }),

            // === AKSI MUNDURKAN TAHAP SEBELUMNYA ===
            Action::make('kembalikan_tahap')
                ->label('Mundurkan Tahap')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('warning')
                ->modalHeading('Mundurkan Status Dokumen ke Tahap Sebelumnya')
                ->modalDescription(fn () => 'Status dokumen '.$this->getRecord()->kode_dokumen.' akan dikembalikan 1 tahap ke belakang.')
                ->modalSubmitActionLabel('Ya, Mundurkan Status')
                ->visible(function (): bool {
                    $user = auth()->user();
                    $record = $this->getRecord();
                    if (! $user || ! $record) {
                        return false;
                    }

                    if ($user->hasAnyRole(['super_admin', 'admin'])) {
                        return in_array($record->status, [
                            DokumenPengeluaran::STATUS_DIVERIFIKASI,
                            DokumenPengeluaran::STATUS_DISAHKAN,
                            DokumenPengeluaran::STATUS_DIBAYAR,
                            DokumenPengeluaran::STATUS_DIARSIPKAN,
                        ]);
                    }

                    if ($user->hasRole('verifikator') && $record->status === DokumenPengeluaran::STATUS_DIVERIFIKASI) {
                        return true;
                    }

                    if ($user->hasRole('ppk') && $record->status === DokumenPengeluaran::STATUS_DISAHKAN) {
                        return true;
                    }

                    if ($user->hasRole('bendahara') && in_array($record->status, [
                        DokumenPengeluaran::STATUS_DIBAYAR,
                        DokumenPengeluaran::STATUS_DIARSIPKAN,
                    ])) {
                        return true;
                    }

                    return false;
                })
                ->form([
                    Textarea::make('alasan')
                        ->label('Alasan Perubahan Status ke Belakang')
                        ->placeholder('Jelaskan alasan pembatalan / pengembalian tahap ini...')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $record = $this->getRecord();
                    $previousMap = [
                        DokumenPengeluaran::STATUS_DIVERIFIKASI => DokumenPengeluaran::STATUS_DIAJUKAN,
                        DokumenPengeluaran::STATUS_DISAHKAN => DokumenPengeluaran::STATUS_DIVERIFIKASI,
                        DokumenPengeluaran::STATUS_DIBAYAR => DokumenPengeluaran::STATUS_DISAHKAN,
                        DokumenPengeluaran::STATUS_DIARSIPKAN => DokumenPengeluaran::STATUS_DIBAYAR,
                    ];

                    $targetStatus = $previousMap[$record->status] ?? null;
                    if (! $targetStatus) {
                        return;
                    }

                    $oldStatus = $record->status;
                    $record->update(['status' => $targetStatus]);

                    Notification::make()
                        ->title('Status Dokumen Dimundurkan')
                        ->body('Status dokumen '.$record->kode_dokumen.' diubah dari '.strtoupper($oldStatus).' kembali menjadi '.strtoupper($targetStatus).'. Alasan: '.$data['alasan'])
                        ->warning()
                        ->sendToDatabase($record->pptk);

                    Notification::make()
                        ->title('Status Berhasil Dimundurkan')
                        ->body('Dokumen '.$record->kode_dokumen.' kini berstatus '.strtoupper($targetStatus).'.')
                        ->success()
                        ->send();
                }),

            // === AKSI PPK: SAHKAN DOKUMEN ===
            Action::make('sahkan')
                ->label('Sahkan Dokumen')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->modalHeading('Pengesahan Dokumen Pengeluaran')
                ->modalDescription('Apakah Anda yakin ingin mengesahkan dokumen pengeluaran ini?')
                ->modalSubmitActionLabel('Ya, Sahkan Dokumen')
                ->requiresConfirmation()
                ->visible(fn () => auth()->user()?->hasRole('ppk') && $this->getRecord()->status === DokumenPengeluaran::STATUS_DIVERIFIKASI)
                ->form([
                    Textarea::make('catatan')
                        ->label('Catatan Pengesahan (Opsional)')
                        ->placeholder('Tambahkan catatan pengesahan jika diperlukan...'),
                ])
                ->action(function (array $data) {
                    $record = $this->getRecord();

                    Pengesahan::create([
                        'dokumen_id' => $record->id,
                        'ppk_id' => auth()->id(),
                        'tanggal_sah' => now(),
                        'catatan' => $data['catatan'] ?? null,
                    ]);

                    $record->update(['status' => DokumenPengeluaran::STATUS_DISAHKAN]);

                    Notification::make()
                        ->title('Dokumen Telah Disahkan')
                        ->body('Dokumen '.$record->kode_dokumen.' telah disahkan oleh PPK.')
                        ->success()
                        ->sendToDatabase($record->pptk);

                    $bendaharaUsers = User::role('bendahara')->get();
                    if ($bendaharaUsers->isNotEmpty()) {
                        Notification::make()
                            ->title('Dokumen Menunggu Pembayaran')
                            ->body('Dokumen '.$record->kode_dokumen.' telah disahkan dan menunggu proses pembayaran.')
                            ->info()
                            ->sendToDatabase($bendaharaUsers);
                    }

                    Notification::make()
                        ->title('Dokumen Berhasil Disahkan')
                        ->body('Dokumen '.$record->kode_dokumen.' telah disahkan dan diteruskan ke Bendahara.')
                        ->success()
                        ->send();
                }),

            // === AKSI BENDAHARA: BAYAR / INPUT BKU ===
            Action::make('bayar')
                ->label('Bayar / Input No. BKU')
                ->icon('heroicon-o-currency-dollar')
                ->color('success')
                ->modalHeading('Pencairan Dana & Input No. BKU')
                ->modalDescription('Masukkan No. BKU untuk mencatat realisasi pembayaran dokumen pengeluaran ini.')
                ->modalSubmitActionLabel('Konfirmasi Pembayaran')
                ->visible(fn () => auth()->user()?->hasRole('bendahara') && $this->getRecord()->status === DokumenPengeluaran::STATUS_DISAHKAN)
                ->form([
                    TextInput::make('nomor_spj')
                        ->label('No. BKU')
                        ->placeholder('Contoh: BKU/BLUD/2026/001')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $record = $this->getRecord();

                    Pembayaran::create([
                        'dokumen_id' => $record->id,
                        'bendahara_id' => auth()->id(),
                        'tanggal_bayar' => now(),
                        'nomor_spj' => $data['nomor_spj'],
                        'status_bayar' => 'Lunas',
                    ]);

                    $record->update(['status' => DokumenPengeluaran::STATUS_DIBAYAR]);

                    Notification::make()
                        ->title('Dana Telah Dicairkan')
                        ->body('Dana untuk Dokumen '.$record->kode_dokumen.' telah dicairkan (No. BKU: '.$data['nomor_spj'].').')
                        ->success()
                        ->sendToDatabase($record->pptk);

                    Notification::make()
                        ->title('Pembayaran Berhasil Dicatat')
                        ->body('Status dokumen telah diperbarui menjadi DIBAYAR.')
                        ->success()
                        ->send();
                }),

            // === AKSI BENDAHARA: ARSIPKAN ===
            Action::make('arsipkan')
                ->label('Arsipkan')
                ->icon('heroicon-o-archive-box')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Arsipkan Dokumen')
                ->modalDescription('Dokumen yang diarsipkan menandakan seluruh proses transaksi telah selesai. Lanjutkan?')
                ->modalSubmitActionLabel('Arsipkan Dokumen')
                ->visible(fn () => auth()->user()?->hasRole('bendahara') && $this->getRecord()->status === DokumenPengeluaran::STATUS_DIBAYAR)
                ->action(function () {
                    $record = $this->getRecord();
                    $record->update(['status' => DokumenPengeluaran::STATUS_DIARSIPKAN]);

                    Notification::make()
                        ->title('Dokumen Diarsipkan')
                        ->body('Dokumen '.$record->kode_dokumen.' telah diarsipkan.')
                        ->success()
                        ->sendToDatabase($record->pptk);

                    Notification::make()
                        ->title('Dokumen Berhasil Diarsipkan')
                        ->body('Dokumen telah dipindahkan ke arsip.')
                        ->success()
                        ->send();
                }),

            // === EDIT / UBAH ===
            EditAction::make()
                ->label('Ubah')
                ->visible(fn () => (auth()->user()?->hasRole('pptk') && in_array($this->getRecord()->status, [
                    DokumenPengeluaran::STATUS_DRAFT,
                    DokumenPengeluaran::STATUS_DIAJUKAN,
                    DokumenPengeluaran::STATUS_DIKEMBALIKAN,
                ])) || auth()->user()?->hasAnyRole(['super_admin', 'admin'])),

            // === HAPUS ===
            DeleteAction::make()
                ->label('Hapus')
                ->visible(fn () => auth()->user()?->hasAnyRole(['super_admin', 'admin']) || (auth()->user()?->hasRole('pptk') && in_array($this->getRecord()->status, [
                    DokumenPengeluaran::STATUS_DRAFT,
                    DokumenPengeluaran::STATUS_DIAJUKAN,
                    DokumenPengeluaran::STATUS_DIKEMBALIKAN,
                ]))),
        ];
    }
}
