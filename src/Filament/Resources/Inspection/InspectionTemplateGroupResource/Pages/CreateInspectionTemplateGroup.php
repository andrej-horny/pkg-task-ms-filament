<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionTemplateGroupResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Inspections\CreateInspectionTemplateGroupUseCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Inspections\InspectionTemplateGroupMapper;
use Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionTemplateGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateInspectionTemplateGroup extends CreateRecord
{
    protected static string $resource = InspectionTemplateGroupResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::inspections/inspection-template-group.create_heading');
    } 

    protected function handleRecordCreation(array $data): Model
    {
        $templateGroup = app(CreateInspectionTemplateGroupUseCase::class)->execute($data);
        return app(InspectionTemplateGroupMapper::class)->toEloquent($templateGroup);
    }    
}
