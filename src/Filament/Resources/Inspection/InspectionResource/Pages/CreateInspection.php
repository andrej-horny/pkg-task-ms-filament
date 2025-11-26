<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionResource;
use App\Models\InspectionAssignment;
use Dpb\Package\TaskMS\Application\UseCase\Inspections\CreateInspectionUseCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Inspections\InspectionMapper;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateInspection extends CreateRecord
{
    protected static string $resource = InspectionResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::inspections/inspection.create_heading');
    } 

    protected function handleRecordCreation(array $data): Model
    {
        $inspection = app(CreateInspectionUseCase::class)->execute($data);
        return app(InspectionMapper::class)->toEloquent($inspection);
    }    
}
