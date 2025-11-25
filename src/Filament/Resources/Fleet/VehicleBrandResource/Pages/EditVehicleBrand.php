<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Fleet\UpdateVehicleBrandUseCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditVehicleBrand extends EditRecord
{
    protected static string $resource = VehicleBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-brand.update_heading', ['title' => $this->record->title]);
    } 

    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        $vehicleBrand = app(UpdateVehicleBrandUseCase::class)->execute($record->id, $data);
        return $record;
    }      
}
