<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketTypeResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Tickets\UpdateTicketTypeUseCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditTicketType extends EditRecord
{
    protected static string $resource = TicketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tickets/ticket-type.update_heading', ['title' => $this->record->title]);
    }    

    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        $ticketType = app(UpdateTicketTypeUseCase::class)->execute($record->id, $data);
        return $record;
    }      
}
