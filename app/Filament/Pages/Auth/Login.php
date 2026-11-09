<?php

namespace App\Filament\Pages\Auth;

use App\Models\DokumenPengeluaran;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    protected string $view = 'filament.pages.auth.login';

    public function getTitle(): string|Htmlable
    {
        return 'SI-VERIF BLUD - Sistem Verifikasi Dokumen Pengeluaran';
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Alamat email')
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Kata sandi')
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->extraInputAttributes(['tabindex' => 2]);
    }

    protected function getRememberFormComponent(): Component
    {
        return Checkbox::make('remember')
            ->label('Ingat saya');
    }

    public function getRecentDocuments()
    {
        return DokumenPengeluaran::with('bidang')
            ->where('status', '!=', DokumenPengeluaran::STATUS_DRAFT)
            ->latest('tanggal_ajuan')
            ->latest('id')
            ->take(3)
            ->get();
    }

    public function getStatsData(): array
    {
        $total = DokumenPengeluaran::where('status', '!=', DokumenPengeluaran::STATUS_DRAFT)->count();
        $verified = DokumenPengeluaran::whereIn('status', [
            DokumenPengeluaran::STATUS_DIVERIFIKASI,
            DokumenPengeluaran::STATUS_DISAHKAN,
            DokumenPengeluaran::STATUS_DIBAYAR,
            DokumenPengeluaran::STATUS_DIARSIPKAN,
        ])->count();

        $percentage = $total > 0 ? round(($verified / $total) * 100, 1) : 0;

        return [
            'total' => $total,
            'rate' => $percentage.'%',
        ];
    }
}
