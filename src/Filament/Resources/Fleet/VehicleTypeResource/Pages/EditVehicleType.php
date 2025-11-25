<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleTypeResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Fleet\UpdateVehicleTypeUseCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditVehicleType extends EditRecord
{
    protected static string $resource = VehicleTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-type.update_heading', ['title' => $this->record->title]);
    }   
    
    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        $vehicleType = app(UpdateVehicleTypeUseCase::class)->execute($record->id, $data);
        return $record;
    }     
}
