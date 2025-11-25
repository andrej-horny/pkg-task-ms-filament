<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleModelResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListVehicleModels extends ListRecords
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return '';
        // return __('tms-ui::fleet/vehicle-type.list_heading');
    }     
}
