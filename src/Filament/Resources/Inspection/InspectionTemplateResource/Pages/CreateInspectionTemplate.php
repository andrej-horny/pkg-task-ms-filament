<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionTemplateResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionTemplateResource;
use Dpb\Package\TaskMS\Application\UseCase\Inspections\CreateInspectionTemplateUseCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Inspections\InspectionTemplateMapper;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateInspectionTemplate extends CreateRecord
{
    protected static string $resource = InspectionTemplateResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::inspections/inspection-template.create_heading');
    } 

    protected function handleRecordCreation(array $data): Model
    {
        $ticket = app(CreateInspectionTemplateUseCase::class)->execute($data);
        return app(InspectionTemplateMapper::class)->toEloquent($ticket);
    }
}
