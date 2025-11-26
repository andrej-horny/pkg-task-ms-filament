<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Tickets\UpdateTicketUseCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditTicket extends EditRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tickets/ticket.update_heading', ['title' => $this->record->id]);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $ticket = app(UpdateTicketUseCase::class)->execute($record->id, $data);
        return $record;
    }
}
