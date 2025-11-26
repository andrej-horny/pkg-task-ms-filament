<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Inspections\UpdateInspectionUseCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditInspection extends EditRecord
{
    protected static string $resource = InspectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::inspections/inspection.update_heading', ['title' => $this->record->id]);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // dd($this->getRedirectUrl());
        $inspection = app(UpdateInspectionUseCase::class)->execute($record->id, $data);
        return $record;
    }

}
