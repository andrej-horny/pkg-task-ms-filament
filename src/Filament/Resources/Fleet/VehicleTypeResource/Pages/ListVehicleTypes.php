<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleTypeResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListVehicleTypes extends ListRecords
{
    protected static string $resource = VehicleTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                // ->visible(auth()->user()->can('fleet.vehicle-type.create')),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return '';
        // return __('tms-ui::fleet/vehicle-type.list_heading');
    }       
}
