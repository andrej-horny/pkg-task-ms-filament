<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleGroupResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Fleet\CreateVehicleGroupUseCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Fleet\VehicleGroupMapper;
use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateVehicleGroup extends CreateRecord
{
    protected static string $resource = VehicleGroupResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-group.form.create_heading');
    }     

    protected function handleRecordCreation(array $data): Model    
    {       
        $vehicleGroup = app(CreateVehicleGroupUseCase::class)->execute($data);
        return app(VehicleGroupMapper::class)->toEloquent($vehicleGroup);
    }         
}
