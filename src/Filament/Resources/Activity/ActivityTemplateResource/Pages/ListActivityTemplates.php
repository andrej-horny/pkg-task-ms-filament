<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Activity\ActivityTemplateResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Activity\ActivityTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListActivityTemplates extends ListRecords
{
    protected static string $resource = ActivityTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::activities/activity-template.list_heading');
    }       
}
