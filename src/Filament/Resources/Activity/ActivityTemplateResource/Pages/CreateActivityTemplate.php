<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Activity\ActivityTemplateResource\Pages;

use Dpb\Package\TaskMS\Application\Activities\CreateActivityTemplateUesCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Activities\ActivityTemplateMapper;
use Dpb\Package\TaskMSFilament\Filament\Resources\Activity\ActivityTemplateResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateActivityTemplate extends CreateRecord
{
    protected static string $resource = ActivityTemplateResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('activities/activity-template.create_heading');
    }     

    protected function handleRecordCreation(array $data): Model    
    {       
        $template = app(CreateActivityTemplateUesCase::class)->execute($data);
        return app(ActivityTemplateMapper::class)->toEloquent($template);
    }     
}
