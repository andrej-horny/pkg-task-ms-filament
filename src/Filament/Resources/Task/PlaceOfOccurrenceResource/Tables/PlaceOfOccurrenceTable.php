<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\PlaceOfOccurrenceResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class PlaceOfOccurrenceTable
{
    public static function make(Table $table): Table
    {
        return $table
            // ->heading(__('tms-ui::tasks/place-of-occurrence.table.heading'))
            ->emptyStateHeading(__('tms-ui::tasks/place-of-occurrence.table.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                // uri
                Tables\Columns\TextColumn::make('uri')
                    ->label(__('tms-ui::tasks/place-of-occurrence.table.columns.uri.label'))
                    ->tooltip(__('tms-ui::tasks/place-of-occurrence.table.columns.uri.tooltip')),
                // title
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::tasks/place-of-occurrence.table.columns.title')),
                // description
                Tables\Columns\TextColumn::make('description')
                    ->label(__('tms-ui::tasks/place-of-occurrence.table.columns.description')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ImportAction::make()
                //     ->importer(taskGroupImporter::class)
                //     ->csvDelimiter(';')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
