<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Author')
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) => $query
                            ->whereIn('role', ['employee', 'employer']),
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('title')
                    ->required(),

                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
