<?php

namespace App\Filament\Resources\DokumenPengeluarans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                \Filament\Forms\Components\Hidden::make('pptk_id')
                    ->default(fn () => auth()->id()),
                Select::make('jenis_dokumen')
                    ->options(fn () => \App\Models\JenisDokumen::pluck('nama_jenis', 'kode_jenis')->toArray())
                    ->searchable()
                    ->required(),
                Select::make('sumber_dana')
                    ->options(fn () => \App\Models\SumberDana::pluck('nama', 'nama')->toArray())
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
                                <a href="' . url('/admin/kelengkapan-berkas') . '" target="_blank" style="font-size: 11.5px; color: #b45309; font-weight: 700; text-decoration: underline; display: flex; align-items: center; gap: 4px; margin-top: 1px; transition: color 0.15s;">
                                    (Cek Kembali Menu Kelengkapan Berkas 
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 12px; height: 12px;">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>)
                                </a>
                            </div>
                        </div>
                    ')),
                \Filament\Forms\Components\Hidden::make('status')
                    ->default('diajukan'),
                \Filament\Forms\Components\Repeater::make('file_path')
                    ->label('Dokumen Lampiran')
                    ->schema([
                        Select::make('tipe_sumber')
                            ->label('Sumber Dokumen')
                            ->options([
                                'upload' => '📄 Unggah File PDF (Maksimal 1MB)',
                                'link' => '🔗 Tautan Google Drive (Jika File > 1MB)',
                            ])
                            ->default('upload')
                            ->live()
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('judul')
                            ->label('Judul / Nama Dokumen')
                            ->placeholder('Contoh: Kwitansi Pembelian, SPJ Obat, Bukti Transfer')
                            ->required(),
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
                            ->required(fn ($get) => $get('tipe_sumber') !== 'link'),
                        TextInput::make('link_drive')
                            ->label('Tautan Google Drive')
                            ->placeholder('https://drive.google.com/file/d/...')
                            ->url()
                            ->helperText('Masukkan URL Google Drive (Akses file: Public / Anyone with link).')
                            ->visible(fn ($get) => $get('tipe_sumber') === 'link')
                            ->required(fn ($get) => $get('tipe_sumber') === 'link'),
                    ])
                    ->columns(2)
                    ->addActionLabel('Tambah Dokumen Lampiran')
                    ->reorderable()
                    ->collapsible()
                    ->defaultItems(1)
                    ->columnSpanFull(),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
            ]);
    }
}
