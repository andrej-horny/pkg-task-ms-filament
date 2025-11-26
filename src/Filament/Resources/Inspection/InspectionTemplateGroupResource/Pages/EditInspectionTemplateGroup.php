<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionTemplateGroupResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Inspections\UpdateInspectionTempalteGroupUseCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionTemplateGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditInspectionTemplateGroup extends EditRecord
{
    protected static string $resource = InspectionTemplateGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::inspections/inspection-template-group.update_heading', ['title' => $this->record->id]);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $templateGroup = app(UpdateInspectionTempalteGroupUseCase::class)->execute($record->id, $data);
        return $record;
    }    
}
