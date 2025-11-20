<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Tables;

use Dpb\Package\TaskMSFilament\Models\TicketAssignment;
use Dpb\Package\TaskMSFilament\Models\TicketAssignment;
use Dpb\Package\TaskMSFilament\Services\TicketAssignmentRepository;
use Dpb\Package\TaskMSFilament\Services\TS\TicketAssignmentService;
use Dpb\Package\Tickets\Models\Ticket;
use Filament\Tables\Actions\Action;

class CreateTicketAction
{
    public static function make($uri): Action
    {
        return Action::make($uri)
            ->label(__('tms-ui::tickets/ticket.table.actions.create_ticket'))
            ->button()
            ->action(function (TicketAssignment $record, TicketAssignmentRepository $ticketAssignmentRepository) {
                $ticketAssignmentRepository->createFromTicketAssignment($record);
            })
            ->visible(function (TicketAssignment $record, TicketAssignment $ticketAssignment) {
                // return true;
                // return $ticketAssignment->whereHasMorph($record, $record->getMorphClass());
                return !TicketAssignment::where('source_type', $record->incident->getMorphClass())
                    ->where('source_id', $record->id)
                    ->exists();
            });
    }
}
