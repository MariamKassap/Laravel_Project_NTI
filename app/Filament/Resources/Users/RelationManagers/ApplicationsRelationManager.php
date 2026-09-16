<?php

namespace App\Filament\Resources\Users\RelationManagers;


use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions\ViewAction;


class ApplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'applications';

    public static function canViewForRecord(
        Model $ownerRecord,
        string $pageClass
    ): bool {
        return $ownerRecord->isEmployee();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('job_id')
                    ->relationship('job', 'title')
                    ->required(),
                Select::make('cv_id')
                    ->relationship('cv', 'title')
                    ->required(),
                Select::make('status')
                    ->label('Application Status')
                    ->options([
                        'pending' => 'Pending',
                        'waiting_list' => 'Waiting list',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('job.title')
                    ->label('Job')
                    ->searchable(),
                TextColumn::make('cv.title')
                    ->label('CV')
                    ->searchable(),
                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'waiting_list' => 'Waiting List',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                    ]),
                TextColumn::make('created_at')
                    ->label('Applied At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
