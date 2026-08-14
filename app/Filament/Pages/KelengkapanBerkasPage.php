<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\View\View;

class KelengkapanBerkasPage extends Page
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Kelengkapan Berkas';
    protected static ?string $title = 'Pedoman Kelengkapan Berkas Dokumen Pengeluaran';
    protected static \UnitEnum|string|null $navigationGroup = 'Dokumen';
    protected static ?int $navigationSort = 2;
    protected static ?string $slug = 'kelengkapan-berkas';

    protected string $view = 'filament.pages.kelengkapan-berkas';

    public string $activeCategory = 'gaji_asn';
    public string $activeGroup = 'semua';
    public string $activeTab = 'ceklis'; // 'ceklis' or 'lembar_cetak'
    public string $searchQuery = '';
    public array $checkedItems = [];
    public string $nomorDokumen = '';
    public string $catatanVerifikasi = '';

    public function setGroup(string $group): void
    {
        $this->activeGroup = $group;
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function mount(): void
    {
        $this->activeCategory = request()->query('kategori', 'gaji_asn');
        $this->initCheckedItems();
    }

    public function setCategory(string $category): void
    {
        $this->activeCategory = $category;
        $this->initCheckedItems();
    }

    public function toggleCheck(string $itemKey, string $status): void
    {
        if (isset($this->checkedItems[$itemKey]) && $this->checkedItems[$itemKey] === $status) {
            unset($this->checkedItems[$itemKey]);
        } else {
            $this->checkedItems[$itemKey] = $status;
        }
    }

    public function resetChecklist(): void
    {
        $this->initCheckedItems();
        $this->catatanVerifikasi = '';
    }

    private function initCheckedItems(): void
    {
        $this->checkedItems = [];
    }

    public function getHeading(): string
    {
        return '';
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->can('View:KelengkapanBerkasPage') ?? false;
    }

    public function getHeader(): ?View
    {
        return null;
    }
}
