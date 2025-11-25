<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleModelResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Fleet\CreateVehicleModelUseCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Fleet\VehicleModelMapper;
use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleModelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateVehicleModel extends CreateRecord
{
    protected static string $resource = VehicleModelResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-model.create_heading');
    }   
    
    protected function handleRecordCreation(array $data): Model    
    {       
        $vehicleModel = app(CreateVehicleModelUseCase::class)->execute($data);
        return app(VehicleModelMapper::class)->toEloquent($vehicleModel);
    }       
}
