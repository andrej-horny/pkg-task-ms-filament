<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Tables;

use Dpb\Package\TaskMSFilament\Models\TicketAssignment;
use Dpb\Package\TaskMSFilament\States;
use Filament\Tables;
use Filament\Tables\Table;

class TicketAssignmentTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::tickets/ticket.table.heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->recordClasses(fn($record) => match ($record->incident->state?->getValue()) {
                States\Ticket\Created::$name => 'bg-blue-200',
                States\Ticket\Closed::$name => 'bg-green-200',
                default => null,
            })
            ->columns([
                Tables\Columns\TextColumn::make('incident.date')
                    ->label(__('tms-ui::tickets/ticket.table.columns.date'))
                    ->date(),
                Tables\Columns\TextColumn::make('subject.code.code')
                    ->label(__('tms-ui::tickets/ticket.table.columns.subject')),
                // ->state(fn(Ticket $record, TicketAssignment $incidentAssignment) => $incidentAssignment->whereBelongsTo($record)->first()?->subject?->code?->code),
                Tables\Columns\TextColumn::make('incident.description')
                    ->label(__('tms-ui::tickets/ticket.table.columns.description'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->label(__('tms-ui::tickets/ticket.table.columns.state'))
                    ->state(fn(TicketAssignment $record) => $record->incident?->state?->label())
                    ->badge(),
                Tables\Columns\TextColumn::make('incident.type.title')
                    ->label(__('tms-ui::tickets/ticket.table.columns.type'))
                    ->badge(),
            ])
            ->filters(TicketTableFilters::make())
            ->headerActions([
                Tables\Actions\CreateAction::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateRecordDataUsing(function (
                        $record,
                        array $data,
                        TicketAssignment $incidentAssignment,
                    ): array {

                        $data['subject_id'] = $incidentAssignment->whereBelongsTo($record)->first()->subject->id;
                        dd($data);
                        return $data;
                    }),
                Tables\Actions\DeleteAction::make(),
                CreateTaskAction::make('create_task'),
                CreateTicketAction::make('create_ticket'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
