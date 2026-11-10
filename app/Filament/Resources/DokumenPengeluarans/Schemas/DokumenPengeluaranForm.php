<?php

namespace App\Filament\Resources\DokumenPengeluarans\Schemas;

use App\Models\DokumenPengeluaran;
use App\Models\JenisDokumen;
use App\Models\SumberDana;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use Illuminate\Support\HtmlString;

class DokumenPengeluaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                ToggleButtons::make('status')
                    ->label('Mode Penyimpanan Dokumen')
                    ->inline()
                    ->options([
                        DokumenPengeluaran::STATUS_DIAJUKAN => 'Ajukan Langsung ke Verifikator',
                        DokumenPengeluaran::STATUS_DRAFT => 'Simpan sebagai Draft (Belum Diajukan)',
                    ])
                    ->icons([
                        DokumenPengeluaran::STATUS_DIAJUKAN => 'heroicon-o-paper-airplane',
                        DokumenPengeluaran::STATUS_DRAFT => 'heroicon-o-document-duplicate',
                    ])
                    ->colors([
                        DokumenPengeluaran::STATUS_DIAJUKAN => 'primary',
                        DokumenPengeluaran::STATUS_DRAFT => 'warning',
                    ])
                    ->default(DokumenPengeluaran::STATUS_DIAJUKAN)
                    ->live()
                    ->required()
                    ->visible(fn ($record) => ! $record || in_array($record->status, [DokumenPengeluaran::STATUS_DRAFT, DokumenPengeluaran::STATUS_DIAJUKAN]))
                    ->helperText('Pilih "Simpan sebagai Draft" jika ingin menyimpan data terlebih dahulu tanpa langsung mengirim ke Verifikator.')
                    ->columnSpanFull(),
                Placeholder::make('alert_mode_penyimpanan')
                    ->hiddenLabel()
                    ->content(function ($get) {
                        $status = $get('status') ?? DokumenPengeluaran::STATUS_DIAJUKAN;

                        if ($status === DokumenPengeluaran::STATUS_DRAFT) {
                            return new HtmlString('
                                <div style="display: flex; align-items: flex-start; gap: 12px; padding: 11px 15px; background-color: #fffbeb; border: 1.5px solid #f59e0b; border-left: 5px solid #d97706; border-radius: 8px; box-shadow: 0 1px 3px rgba(217, 119, 6, 0.1); margin-top: -6px; margin-bottom: 6px;">
                                    <div style="display: flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background-color: #fef3c7; color: #d97706; flex-shrink: 0; margin-top: 1px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 17px; height: 17px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                        </svg>
                                    </div>
                                    <div style="font-size: 12.5px; line-height: 1.45; color: #92400e;">
                                        <span style="font-weight: 800; letter-spacing: 0.02em; color: #b45309;">ALERT MODE DRAFT:</span>
                                        Dokumen ini akan disimpan secara lokal sebagai <strong>Draft</strong> dan <u>belum diajukan ke Verifikator</u>. Pengunggahan berkas lampiran bersifat opsional dan dapat Anda lengkapi sebelum diajukan resmi melalui menu tab <em>Draft</em>.
                                    </div>
                                </div>
                            ');
                        }

                        return new HtmlString('
                            <div style="display: flex; align-items: flex-start; gap: 12px; padding: 11px 15px; background-color: #eef2ff; border: 1.5px solid #6366f1; border-left: 5px solid #4f46e5; border-radius: 8px; box-shadow: 0 1px 3px rgba(79, 70, 229, 0.1); margin-top: -6px; margin-bottom: 6px;">
                                <div style="display: flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background-color: #e0e7ff; color: #4338ca; flex-shrink: 0; margin-top: 1px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 17px; height: 17px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.126A59.768 59.768 0 0 1 21.485 12 59.77 59.77 0 0 1 3.27 20.876L5.999 12Zm0 0h7.5" />
                                    </svg>
                                </div>
                                <div style="font-size: 12.5px; line-height: 1.45; color: #312e81;">
                                    <span style="font-weight: 800; letter-spacing: 0.02em; color: #4338ca;">ALERT AJUKAN LANGSUNG:</span>
                                    Dokumen ini akan <strong>langsung dikirimkan ke antrean Verifikator</strong> setelah disimpan. Notifikasi sistem otomatis terkirim. Pastikan minimal 1 berkas lampiran (PDF maks 1MB atau link Google Drive) telah lengkap & valid.
                                </div>
                            </div>
                        ');
                    })
                    ->visible(fn ($record) => ! $record || in_array($record->status, [DokumenPengeluaran::STATUS_DRAFT, DokumenPengeluaran::STATUS_DIAJUKAN]))
                    ->columnSpanFull(),
                TextInput::make('kode_dokumen')
                    ->disabled()
                    ->dehydrated(false)
                    ->hiddenOn('create')
                    ->columnSpanFull(),
                Select::make('bidang_id')
                    ->label('Bidang / Unit Kerja')
                    ->relationship('bidang', 'nama_bidang')
                    ->default(fn () => auth()->user()?->bidang_id)
                    ->disabled(fn () => auth()->user()?->hasRole('pptk') && filled(auth()->user()?->bidang_id))
                    ->dehydrated()
                    ->required(),
                Hidden::make('pptk_id')
                    ->default(fn () => auth()->id()),
                Select::make('jenis_dokumen')
                    ->options(fn () => JenisDokumen::pluck('nama_jenis', 'kode_jenis')->toArray())
                    ->searchable()
                    ->required(),
                Select::make('sumber_dana')
                    ->options(fn () => SumberDana::pluck('nama', 'nama')->toArray())
                    ->searchable()
                    ->required(),
                TextInput::make('nominal')
                    ->label('Nominal Pengajuan')
                    ->required()
                    ->prefix('Rp')
                    ->mask(RawJs::make('$money($input, ".", ",", 0)'))
                    ->stripCharacters('.')
                    ->formatStateUsing(fn ($state) => filled($state) ? number_format((float) $state, 0, '', '') : null)
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? (float) str_replace(['.', ','], '', (string) $state) : null),
                DatePicker::make('tanggal_ajuan')
                    ->default(now())
                    ->required(),
                Placeholder::make('catatan_kelengkapan')
                    ->hiddenLabel()
                    ->content(new HtmlString('
                        <div style="display: flex; align-items: center; gap: 10px; padding: 9px 14px; background: #fffbeb; border: 1.5px solid #f59e0b; border-left: 5px solid #d97706; border-radius: 8px; box-shadow: 0 2px 8px rgba(217, 119, 6, 0.12); margin-top: 24px; min-height: 42px; box-sizing: border-box;">
                            <div style="display: flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background: #fef3c7; border: 1px solid #fde68a; flex-shrink: 0;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 17px; height: 17px; color: #d97706; display: inline-block; vertical-align: middle;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <div style="font-size: 12px; line-height: 1.35;">
                                <span style="font-weight: 800; color: #b45309; letter-spacing: 0.01em;">NOTED :</span>
                                <strong style="color: #92400e; font-weight: 700;">Pastikan Kelengkapan Dokumen</strong>
                                <a href="'.url('/admin/kelengkapan-berkas').'" target="_blank" style="font-size: 11.5px; color: #b45309; font-weight: 700; text-decoration: underline; display: flex; align-items: center; gap: 4px; margin-top: 1px; transition: color 0.15s;">
                                    (Cek Kembali Menu Kelengkapan Berkas 
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 12px; height: 12px;">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>)
                                </a>
                            </div>
                        </div>
                    ')),
                Repeater::make('file_path')
                    ->label('Dokumen Lampiran')
                    ->schema([
                        Select::make('tipe_sumber')
                            ->label('Sumber Dokumen')
                            ->options([
                                'upload' => 'Unggah File PDF (Maksimal 1MB)',
                                'link' => 'Tautan Google Drive (Jika File > 1MB)',
                            ])
                            ->default('upload')
                            ->live()
                            ->required(fn ($get) => $get('../../status') !== DokumenPengeluaran::STATUS_DRAFT)
                            ->columnSpanFull(),
                        TextInput::make('judul')
                            ->label('Judul / Nama Dokumen')
                            ->placeholder('Contoh: Kwitansi Pembelian, SPJ Obat, Bukti Transfer')
                            ->required(fn ($get) => $get('../../status') !== DokumenPengeluaran::STATUS_DRAFT || filled($get('file')) || filled($get('link_drive'))),
                        FileUpload::make('file')
                            ->label('File PDF (Maksimal 1MB)')
                            ->disk('public')
                            ->directory('dokumen_pengeluaran')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(1024)
                            ->openable()
                            ->downloadable()
                            ->helperText('Maksimal 1MB. Jika file > 1MB, pilih opsi Google Drive.')
                            ->visible(fn ($get) => $get('tipe_sumber') !== 'link')
                            ->required(fn ($get) => $get('tipe_sumber') !== 'link' && $get('../../status') !== DokumenPengeluaran::STATUS_DRAFT),
                        TextInput::make('link_drive')
                            ->label('Tautan Google Drive')
                            ->placeholder('https://drive.google.com/file/d/...')
                            ->url()
                            ->helperText('Masukkan URL Google Drive (Akses file: Public / Anyone with link).')
                            ->visible(fn ($get) => $get('tipe_sumber') === 'link')
                            ->required(fn ($get) => $get('tipe_sumber') === 'link' && $get('../../status') !== DokumenPengeluaran::STATUS_DRAFT),
                    ])
                    ->columns(2)
                    ->addActionLabel('Tambah Dokumen Lampiran')
                    ->reorderable()
                    ->collapsible()
                    ->defaultItems(1)
                    ->minItems(fn ($get) => $get('status') === DokumenPengeluaran::STATUS_DRAFT ? 0 : 1)
                    ->mutateDehydratedStateUsing(function ($state): array {
                        if (! is_array($state)) {
                            return [];
                        }

                        return array_values(array_filter($state, function ($item) {
                            if (! is_array($item)) {
                                return filled($item);
                            }

                            return filled($item['judul'] ?? null) || filled($item['file'] ?? null) || filled($item['link_drive'] ?? null);
                        }));
                    })
                    ->columnSpanFull(),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
            ]);
    }
}
