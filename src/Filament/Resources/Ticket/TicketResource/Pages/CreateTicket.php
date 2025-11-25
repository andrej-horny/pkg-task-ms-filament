<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Tickets\CreateTicketUseCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Tickets\TicketMapper;
use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tickets/ticket.create_heading');
    } 

    protected function handleRecordCreation(array $data): Model
    {
        $ticket = app(CreateTicketUseCase::class)->execute($data);
        return app(TicketMapper::class)->toEloquent($ticket);
    }
}
