<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicle extends EditRecord
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
