<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\MaintenanceGroupResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\MaintenanceGroupResource;
use Dpb\Package\Fleet\Repositories\VehicleRepositoryInterface;
use Dpb\Package\TaskMS\Application\UseCase\Fleet\UpdateMaintenanceGroupUseCase;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditMaintenanceGroup extends EditRecord
{
    protected static string $resource = MaintenanceGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/maintenance-group.form.update_heading', ['title' => $this->record->code]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // vehicles
        $vehicleRepo = app(VehicleRepositoryInterface::class);
        $data['vehicles'] = array_map(
            fn($vehicle) => $vehicle->id(),
            $vehicleRepo->byMaintenanceGroup($this->record->code)
        );

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        $maintenanceGroup = app(UpdateMaintenanceGroupUseCase::class)->execute($record->id, $data);
        return $record;
    }  
}
