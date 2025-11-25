<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleTypeResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Fleet\CreateVehicleTypeUseCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Fleet\VehicleTypeMapper;
use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateVehicleType extends CreateRecord
{
    protected static string $resource = VehicleTypeResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-type.create_heading');
    } 

    protected function handleRecordCreation(array $data): Model    
    {       
        $vehicleType = app(CreateVehicleTypeUseCase::class)->execute($data);
        return app(VehicleTypeMapper::class)->toEloquent($vehicleType);
    }            
}
