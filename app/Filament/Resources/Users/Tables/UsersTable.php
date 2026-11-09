<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Alamat Email')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('bidang.nama_bidang')
                    ->label('Bidang')
                    ->placeholder('-')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('status_aktif')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('reset_password')
                    ->label('Reset Password')
                    ->icon('heroicon-o-key')
                    ->color('warning')
                    ->iconButton()
                    ->tooltip('Reset Password User')
                    ->modalHeading(fn (User $record): string => 'Reset Password - '.$record->name)
                    ->modalDescription(fn (User $record): string => 'Masukkan password baru untuk akun '.$record->email.'.')
                    ->modalSubmitActionLabel('Reset Password')
                    ->visible(fn (): bool => (bool) auth()->user()?->hasAnyRole(['super_admin', 'admin']))
                    ->form([
                        TextInput::make('new_password')
                            ->label('Password Baru')
                            ->password()
                            ->revealable()
                            ->default('12345678')
                            ->minLength(8)
                            ->required()
                            ->helperText('Default diisi 12345678, atau ketik password baru minimal 8 karakter.'),
                        TextInput::make('new_password_confirmation')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->revealable()
                            ->default('12345678')
                            ->same('new_password')
                            ->required(),
                    ])
                    ->action(function (User $record, array $data): void {
                        $record->update([
                            'password' => Hash::make($data['new_password']),
                        ]);

                        Notification::make()
                            ->title('Password Akun Direset')
                            ->body('Password akun Anda telah direset oleh Administrator ('.auth()->user()->name.').')
                            ->warning()
                            ->sendToDatabase($record);

                        Notification::make()
                            ->title('Password Berhasil Direset')
                            ->body('Password untuk user '.$record->name.' ('.$record->email.') telah diperbarui.')
                            ->success()
                            ->send();
                    }),
                EditAction::make()
                    ->iconButton()
                    ->tooltip('Edit User'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
