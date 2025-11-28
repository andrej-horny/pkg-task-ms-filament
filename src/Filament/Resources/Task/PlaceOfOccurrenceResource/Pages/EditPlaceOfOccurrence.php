<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\PlaceOfOccurrenceResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Task\PlaceOfOccurrenceResource;
use Dpb\Package\TaskMS\Application\UseCase\Tasks\UpdatePlaceOfOccurrenceUseCase;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditPlaceOfOccurrence extends EditRecord
{
    protected static string $resource = PlaceOfOccurrenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/place-of-occurrence.update_heading', ['title' => $this->record->title]);
    }    

    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        $taskGroup = app(UpdatePlaceOfOccurrenceUseCase::class)->execute($record->id, $data);
        return $record;
    }       
}
