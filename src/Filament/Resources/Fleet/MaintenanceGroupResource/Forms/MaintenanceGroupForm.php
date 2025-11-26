<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\MaintenanceGroupResource\Forms;

use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\Fleet\Models\VehicleType;
use Dpb\Package\Fleet\Repositories\VehicleTypeRepositoryInterface;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Fleet\EloquentVehicle;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Fleet\EloquentVehicleType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;

class MaintenanceGroupForm
{
    public static function make(Form $form): Form
    {
        return $form
            ->schema(static::schema())
            ->columns(11);
    }


    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('code')
                ->columnSpan(1)
                ->label(__('tms-ui::fleet/maintenance-group.form.fields.code.label')),
            Forms\Components\TextInput::make('title')
                ->columnSpan(2)
                ->label(__('tms-ui::fleet/maintenance-group.form.fields.title')),
            // color
            // Forms\Components\ColorPicker::make('color')
            //     ->columnSpan(1)
            //     ->label(__('tms-ui::fleet/maintenance-group.form.fields.color')),
            // vehicle type
            Forms\Components\ToggleButtons::make('vehicle_type_id')
                ->label(__('tms-ui::fleet/maintenance-group.form.fields.vehicle_type'))
                ->columnSpan(4)
                ->options(fn() => EloquentVehicleType::pluck('title', 'id'))
                ->inline()
                ->live(),
            // description
            Forms\Components\TextInput::make('description')
                ->columnSpan(4)
                ->label(__('tms-ui::fleet/maintenance-group.form.fields.description')),
            // vehicels
            Forms\Components\CheckboxList::make('vehicles')
                ->label(__('tms-ui::fleet/maintenance-group.form.fields.vehicles'))
                ->options(function (Get $get, VehicleTypeRepositoryInterface $vtRepo) {
                    $typeCode = $vtRepo->findById($get('vehicle_type_id'))->code();
                    return EloquentVehicle::whereNotNull('code_1')
                        ->byType($typeCode) 
                        ->get()
                        ->mapWithKeys(fn($vehicle) => [
                            $vehicle->id => $vehicle->subjectLabel()
                        ]);
                })
                ->searchable()
                ->bulkToggleable(true)
                ->columnSpanFull()
                ->columns(10)
        ];
    }
}
