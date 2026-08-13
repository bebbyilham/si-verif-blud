<?php

namespace App\Filament\Resources\SumberDanas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SumberDanaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
            ]);
    }
}
