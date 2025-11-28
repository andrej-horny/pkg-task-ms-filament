<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\PlaceOfOccurrenceResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Task\PlaceOfOccurrenceResource;
use Dpb\Package\TaskMS\Application\UseCase\Tasks\CreatePlaceOfOccurrenceUseCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Tasks\PlaceOfOccurrenceMapper;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreatePlaceOfOccurrence extends CreateRecord
{
    protected static string $resource = PlaceOfOccurrenceResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/place-of-occurrence.create_heading');
    }   

    protected function handleRecordCreation(array $data): Model    
    {       
        $taskGroup = app(CreatePlaceOfOccurrenceUseCase::class)->execute($data);
        return app(PlaceOfOccurrenceMapper::class)->toEloquent($taskGroup);
    }    
}
