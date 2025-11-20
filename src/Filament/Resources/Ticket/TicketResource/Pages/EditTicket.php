<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Tickets\UpdateTicketUesCase;
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

    // protected function mutateFormDataBeforeFill(array $data): array
    // {
    //     // $data['subject_id'] = $this->record->subject_id;
    //     // $data['incident']['date'] = $this->record->incident->date;
    //     // $data['incident']['description'] = $this->record->incident->description;
    //     // $data['incident']['type_id'] = $this->record->incident->type_id;
    //     // dd($data);
    //     return $data;
    // }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        dd($this->getRedirectUrl());
        $ticket = app(UpdateTicketUesCase::class)->execute($record->id, $data);
        return $record;
    }
}
