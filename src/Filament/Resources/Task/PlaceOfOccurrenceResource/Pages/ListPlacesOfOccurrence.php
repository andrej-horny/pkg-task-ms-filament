<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\PlaceOfOccurrenceResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Task\PlaceOfOccurrenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListPlacesOfOccurrence extends ListRecords
{
    protected static string $resource = PlaceOfOccurrenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }   

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/place-of-occurrence.list_heading');
    }       
}
