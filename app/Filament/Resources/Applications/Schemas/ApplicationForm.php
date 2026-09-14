<?php

namespace App\Filament\Resources\Applications\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Employee')
                    ->relationship(
                        name: 'employee',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) => $query->where('role', 'employee'),
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('job_id')
                    ->label('Job')
                    ->relationship('job', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('cv_id')
                    ->label('CV')
                    ->relationship('cv', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('status')
                    ->label('Application Status')
                    ->options([
                        'pending' => 'Pending',
                        'waiting_list' => 'Waiting List',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
