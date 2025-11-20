<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketTypeResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketType extends CreateRecord
{
    protected static string $resource = TicketTypeResource::class;
}
