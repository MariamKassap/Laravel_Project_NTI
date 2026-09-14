<?php

namespace App\Filament\Resources\Applications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.name')
                    ->label('Employee')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('job.title')
                    ->label('Job')
                    ->searchable()
                    ->sortable(),

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

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
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
