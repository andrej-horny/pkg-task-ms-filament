<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource;
use Dpb\Package\TaskMSFilament\Services\TicketAssignmentRepository;
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
        // return $this->incidentService->createTicket($data);
        return app(TicketAssignmentRepository::class)->create($data);
    }
}
