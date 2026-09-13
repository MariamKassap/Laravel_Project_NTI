<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),

                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $operation): bool => $operation === 'create'),

                Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'employee' => 'Employee',
                        'employer' => 'Employer',
                    ])
                    ->native(false)
                    ->required(),

                TextInput::make('company')
                    ->visible(fn($get) => $get('role') === 'employer'),

                FileUpload::make('image')
                    ->image(),
            ]);
    }
}
