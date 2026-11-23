<?php

namespace App\Filament\Resources\DokumenPengeluarans\Pages;

use App\Filament\Resources\DokumenPengeluarans\DokumenPengeluaranResource;
use App\Models\DokumenPengeluaran;
use App\Services\DokumenPengeluaranResetService;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class ListDokumenPengeluarans extends ListRecords
{
    protected static string $resource = DokumenPengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reset_data_dokumen')
                ->label('Reset Data')
                ->icon('heroicon-o-arrow-path')
                ->color('danger')
                ->outlined()
                ->visible(fn (): bool => auth()->user()?->can('resetData', DokumenPengeluaran::class) ?? false)
                ->disabled(fn (): bool => DokumenPengeluaran::count() === 0)
                ->tooltip(fn (): string => DokumenPengeluaran::count() === 0
                    ? 'Tidak ada data Dokumen Pengeluaran untuk direset.'
                    : 'Hapus dan reset seluruh data Dokumen Pengeluaran')
                ->modalHeading('Reset Seluruh Data Dokumen Pengeluaran')
                ->modalDescription('Tindakan ini bersifat permanen dan tidak dapat dibatalkan. Pastikan Anda telah melakukan pencadangan data jika diperlukan.')
                ->modalIcon('heroicon-o-exclamation-triangle')
                ->modalIconColor('danger')
                ->modalWidth('lg')
                ->modalSubmitActionLabel('Ya, Reset Semua Data')
                ->schema([
                    Placeholder::make('ringkasan_bahaya')
                        ->hiddenLabel()
                        ->content(function (): HtmlString {
                            $summary = app(DokumenPengeluaranResetService::class)->getSummary();

                            return new HtmlString(
                                '<div style="display: flex; align-items: flex-start; gap: 12px; padding: 12px 15px; background-color: #fef2f2; border: 1.5px solid #ef4444; border-left: 5px solid #dc2626; border-radius: 8px; color: #7f1d1d;">'.
                                    '<div style="display: flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background-color: #fee2e2; color: #dc2626; flex-shrink: 0; margin-top: 2px;">'.
                                        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 17px; height: 17px;">'.
                                            '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />'.
                                        '</svg>'.
                                    '</div>'.
                                    '<div style="font-size: 12.5px; line-height: 1.5;">'.
                                        '<div style="font-weight: 800; color: #991b1b; margin-bottom: 4px;">PERINGATAN: DATA YANG AKAN DIHAPUS PERMANEN</div>'.
                                        '<ul style="margin: 0 0 6px 16px; padding: 0; list-style-type: disc;">'.
                                            '<li>Dokumen Pengeluaran: <strong>'.$summary['dokumen'].'</strong> data</li>'.
                                            '<li>Riwayat Verifikasi: <strong>'.$summary['verifikasi'].'</strong> data &bull; Riwayat Koreksi: <strong>'.$summary['koreksi'].'</strong> data</li>'.
                                            '<li>Data Pengesahan: <strong>'.$summary['pengesahan'].'</strong> data &bull; Data Pembayaran: <strong>'.$summary['pembayaran'].'</strong> data</li>'.
                                        '</ul>'.
                                        '<div style="font-size: 11.5px; color: #991b1b;">Data Master (Bidang, Jenis Dokumen, Sumber Dana, User, Peran) dan riwayat Audit Trail <strong>tidak akan terhapus</strong>.</div>'.
                                    '</div>'.
                                '</div>'
                            );
                        }),
                    Checkbox::make('hapus_lampiran_fisik')
                        ->label('Hapus seluruh file PDF lampiran yang tersimpan di server')
                        ->helperText('Tautan Google Drive tidak terpengaruh; hanya file PDF unggahan lokal yang dibersihkan.')
                        ->default(true),
                    Checkbox::make('hapus_notifikasi_terkait')
                        ->label('Bersihkan notifikasi lonceng terkait dokumen pengeluaran')
                        ->default(true),
                    Textarea::make('alasan')
                        ->label('Alasan Reset Data')
                        ->placeholder('Contoh: Pembersihan data uji coba sebelum operasional produksi')
                        ->rows(2)
                        ->required()
                        ->minLength(10)
                        ->maxLength(255),
                    TextInput::make('konfirmasi_teks')
                        ->label('Konfirmasi Penghapusan')
                        ->placeholder('Ketik: RESET DATA')
                        ->helperText('Ketik persis RESET DATA (huruf kapital) untuk melanjutkan.')
                        ->required()
                        ->rule('in:RESET DATA')
                        ->validationMessages([
                            'in' => 'Harap ketik persis "RESET DATA" (huruf kapital) untuk konfirmasi.',
                        ]),
                    TextInput::make('password')
                        ->label('Kata Sandi Akun Anda')
                        ->password()
                        ->revealable()
                        ->required()
                        ->rule('current_password')
                        ->validationMessages([
                            'current_password' => 'Kata sandi yang Anda masukkan tidak sesuai dengan akun Anda.',
                        ]),
                ])
                ->action(function (array $data): void {
                    if (! (auth()->user()?->can('resetData', DokumenPengeluaran::class) ?? false)) {
                        Notification::make()
                            ->danger()
                            ->title('Akses Ditolak')
                            ->body('Anda tidak memiliki izin untuk mereset data Dokumen Pengeluaran.')
                            ->send();

                        return;
                    }

                    $result = app(DokumenPengeluaranResetService::class)->reset(
                        alasan: (string) $data['alasan'],
                        hapusLampiranFisik: (bool) ($data['hapus_lampiran_fisik'] ?? true),
                        hapusNotifikasiTerkait: (bool) ($data['hapus_notifikasi_terkait'] ?? true),
                    );

                    Notification::make()
                        ->success()
                        ->title('Data Dokumen Pengeluaran Berhasil Direset')
                        ->body(
                            'Sebanyak '.$result['deleted_dokumen'].' dokumen pengeluaran, '.
                            $result['deleted_files'].' berkas PDF lokal, dan '.
                            $result['deleted_notifications'].' notifikasi terkait telah dibersihkan. '.
                            'Riwayat aksi telah tercatat pada Audit Trail.'
                        )
                        ->send();
                }),
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
