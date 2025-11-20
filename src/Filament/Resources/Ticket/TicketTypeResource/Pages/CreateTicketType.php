<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketTypeResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Tickets\CreateTicketTypeUesCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Tickets\TicketTypeMapper;
use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketTypeResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateTicketType extends CreateRecord
{
    protected static string $resource = TicketTypeResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tickets/ticket-type.create_heading');
    }    

    protected function handleRecordCreation(array $data): Model    
    {       
        $ticketType = app(CreateTicketTypeUesCase::class)->execute($data);
        return app(TicketTypeMapper::class)->toEloquent($ticketType);
    }     
}
