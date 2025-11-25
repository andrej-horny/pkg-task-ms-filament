<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListVehicleBrands extends ListRecords
{
    protected static string $resource = VehicleBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-brand.list_heading');
    }     
}
