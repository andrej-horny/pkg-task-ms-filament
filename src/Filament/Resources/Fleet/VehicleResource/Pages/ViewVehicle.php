<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewVehicle extends ViewRecord
{
    protected static string $resource = VehicleResource::class;


    public function getTitle(): string | Htmlable
    {
        return 'vozidlo: ' . $this->record->subjectLabel();
    }

    public function getHeading(): string
    {        
        return 'vozidlo: ' . $this->record->subjectLabel();
    }
}
