<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Tables;

use Dpb\Package\TaskMSFilament\Dpb\Package\TaskMSFilamentlication\Tasks\CreateTaskFromTicketUesCase;
use Dpb\Package\TaskMSFilament\Models\TicketAssignment;
use Filament\Tables\Actions\Action;

class CreateTaskAction
{
    public static function make($uri): Action
    {
        return Action::make($uri)
            ->label(__('tms-ui::tickets/ticket.table.actions.create_ticket'))
            ->button()
            ->action(function (TicketAssignment $record, CreateTaskFromTicketUesCase $useCase) {
                $useCase->execute($record);
            });
    }
}
