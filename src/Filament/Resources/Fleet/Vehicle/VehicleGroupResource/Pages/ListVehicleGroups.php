<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\Vehicle\VehicleGroupResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\Vehicle\VehicleGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleGroups extends ListRecords
{
    protected static string $resource = VehicleGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
