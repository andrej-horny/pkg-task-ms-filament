<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleGroupResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Fleet\UpdateVehicleGroupUseCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditVehicleGroup extends EditRecord
{
    protected static string $resource = VehicleGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-group.form.update_heading', ['title' => $this->record->title]);
    }      

    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        $vehicleGroup = app(UpdateVehicleGroupUseCase::class)->execute($record->id, $data);
        return $record;
    }        
}
