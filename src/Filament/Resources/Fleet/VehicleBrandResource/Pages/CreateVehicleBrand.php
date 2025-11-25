<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Fleet\CreateVehicleBrandUseCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Fleet\VehicleBrandMapper;
use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateVehicleBrand extends CreateRecord
{
    protected static string $resource = VehicleBrandResource::class;
    
    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-brand.create_heading');
    } 

    protected function handleRecordCreation(array $data): Model    
    {       
        $vehicleBrand = app(CreateVehicleBrandUseCase::class)->execute($data);
        return app(VehicleBrandMapper::class)->toEloquent($vehicleBrand);
    }    
}
