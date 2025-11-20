<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Tables;

use Dpb\Package\TaskMSFilament\Models\TicketAssignment;
use Dpb\Package\TaskMSFilament\Models\TicketAssignment;
use Dpb\Package\TaskMSFilament\Services\TS\TicketAssignmentService;
use Dpb\Package\TaskMSFilament\States;
use Dpb\Package\Tickets\Models\Ticket;
use Dpb\Package\Inspections\Models\Inspection;
use Filament\Tables;
use Filament\Tables\Table;

class TicketTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->recordClasses(fn($record) => match ($record->state?->getValue()) {
                States\Ticket\Created::$name => 'bg-blue-200',
                States\Ticket\Closed::$name => 'bg-green-200',
                default => null,
            })
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label(__('tms-ui::tickets/ticket.table.columns.date.label'))
                    ->date(),
                Tables\Columns\TextColumn::make('subject')
                    ->label(__('tms-ui::tickets/ticket.table.columns.subject.label'))
                    ->state(fn(Ticket $record, TicketAssignment $incidentAssignment) => $incidentAssignment->whereBelongsTo($record)->first()?->subject?->code?->code),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('tms-ui::tickets/ticket.table.columns.description.label')),
                Tables\Columns\TextColumn::make('state')
                    ->label(__('tms-ui::tickets/ticket.table.columns.state.label'))
                    ->state(fn(Ticket $record) => $record?->state?->label())
                    ->badge(),
                Tables\Columns\TextColumn::make('type.title')
                    ->label(__('tms-ui::tickets/ticket.table.columns.type.label'))
                    ->badge(),
            ])
            ->filters([
                //
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
                // CreateTaskAction::make('create_task'),
                CreateTicketAction::make('create_ticket'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
