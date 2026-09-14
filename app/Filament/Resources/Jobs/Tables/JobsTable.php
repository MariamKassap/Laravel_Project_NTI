<?php

namespace App\Filament\Resources\Jobs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class JobsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employer.name')
                    ->label('Employer')
                    ->formatStateUsing(
                        fn($state, $record) =>
                        $record->employer?->company
                            ?: $record->employer?->name
                    )
                    ->searchable(query: function ($query, string $search) {
                        $query->whereHas('employer', function ($query) use ($search) {
                            $query->where('company', 'like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%");
                        });
                    })
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Job Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('salary')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('location')
                    ->searchable(),

                TextColumn::make('job_type')
                    ->badge(),

                // TextColumn::make('deadline')
                //     ->date()
                //     ->sortable(),

                //     TextColumn::make('created_at')
                //         ->dateTime()
                //         ->sortable()
                //         ->toggleable(isToggledHiddenByDefault: false),

                //     TextColumn::make('updated_at')
                //         ->dateTime()
                //         ->sortable()
                //         ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([

                SelectFilter::make('job_type')
                    ->label('Job Type')
                    ->options([
                        'full_time' => 'Full Time',
                        'part_time' => 'Part Time',
                        'internship' => 'Internship',
                        'contract' => 'Contract',
                    ]),

                SelectFilter::make('location')
                    ->label('Location')
                    ->options(
                        \App\Models\Job::query()
                            ->whereNotNull('location')
                            ->where('location', '!=', '')
                            ->distinct()
                            ->pluck('location', 'location')
                            ->toArray()
                    ),
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
