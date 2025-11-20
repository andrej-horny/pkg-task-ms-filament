<?php

namespace App\Filament\Resources\Activity\TemplateGroupResource\Pages;

use App\Filament\Resources\Activity\TemplateGroupResource;
use Dpb\Package\TaskMS\Application\UseCase\Activities\CreateActivityTemplateGroupUesCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Activities\ActivityTemplateGroupMapper;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateTemplateGroup extends CreateRecord
{
    protected static string $resource = TemplateGroupResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::activities/activity-template-group.create_heading');
    }   

    protected function handleRecordCreation(array $data): Model    
    {       
        $template = app(CreateActivityTemplateGroupUesCase::class)->execute($data);
        return app(ActivityTemplateGroupMapper::class)->toEloquent($template);
    }      
}
