<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    public static function getLabel(): string
    {
        return 'Profil & Ubah Password';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Profil & Kata Sandi')
                    ->description('Perbarui nama, alamat email, atau ubah kata sandi akun Anda. Kosongkan kolom kata sandi baru jika tidak ingin mengubahnya.')
                    ->schema([
                        $this->getNameFormComponent()
                            ->label('Nama Lengkap'),
                        $this->getEmailFormComponent()
                            ->label('Alamat Email'),
                        $this->getPasswordFormComponent()
                            ->label('Password Baru')
                            ->helperText('Minimal 8 karakter. Kosongkan jika tidak ingin mengubah password.'),
                        $this->getPasswordConfirmationFormComponent()
                            ->label('Konfirmasi Password Baru'),
                        $this->getCurrentPasswordFormComponent()
                            ->label('Password Saat Ini'),
                    ]),
            ]);
    }
}

