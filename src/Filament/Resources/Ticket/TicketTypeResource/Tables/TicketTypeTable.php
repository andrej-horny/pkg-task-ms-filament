<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketTypeResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class TicketTypeTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::tickets/ticket-type.table.heading'))
            ->emptyStateHeading(__('tms-ui::tickets/ticket-type.table.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            // ->recordClasses(fn($record) => match ($record->incident->state?->getValue()) {
            //     States\Ticket\Created::$name => 'bg-blue-200',
            //     States\Ticket\Closed::$name => 'bg-green-200',
            //     default => null,
            // })
            ->columns([
                Tables\Columns\TextColumn::make('code')->label(__('tms-ui::tickets/ticket-type.table.columns.code.label')),
                Tables\Columns\TextColumn::make('title')->label(__('tms-ui::tickets/ticket-type.table.columns.title.label')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);

    }
}
