<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleModelResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Fleet\UpdateVehicleModelUseCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleModelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditVehicleModel extends EditRecord
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-model.update_heading', ['title' => $this->record->title]);
    }      

    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        // dd($data);
        $vehicleModel = app(UpdateVehicleModelUseCase::class)->execute($record->id, $data);
        return $record;
    }        
}
