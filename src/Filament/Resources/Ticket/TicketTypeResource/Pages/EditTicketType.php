<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketTypeResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicketType extends EditRecord
{
    protected static string $resource = TicketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
