<?php

namespace App\Filament\Resources\Jobs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JobForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Company/Employer')
                    ->relationship(
                        name: 'employer',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) => $query->where('role', 'employer'),
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn($record) => filled($record->company)
                            ? $record->company
                            : $record->name
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('salary')
                    ->numeric(),
                TextInput::make('location'),
                Select::make('job_type')
                    ->options([
                        'full_time' => 'Full time',
                        'part_time' => 'Part time',
                        'internship' => 'Internship',
                        'contract' => 'Contract',
                    ]),
                DatePicker::make('deadline'),
            ]);
    }
}
