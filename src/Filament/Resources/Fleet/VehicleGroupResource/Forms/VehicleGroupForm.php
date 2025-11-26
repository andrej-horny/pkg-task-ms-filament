<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleGroupResource\Forms;

use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Fleet\EloquentVehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;

class VehicleGroupForm
{
    public static function make(Form $form): Form
    {
        return $form
            ->schema(static::schema())
            ->columns(7);
    }


    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('code')
                ->label(__('tms-ui::fleet/vehicle-group.form.fields.code.label'))
                ->columnSpan(1),
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::fleet/vehicle-group.form.fields.title'))
                ->columnSpan(2),
            Forms\Components\TextInput::make('description')
                ->label(__('tms-ui::fleet/vehicle-group.form.fields.description'))
                ->columnSpan(4),
            // vehicels
            Forms\Components\CheckboxList::make('vehicles')
                ->label(__('tms-ui::fleet/vehicle-group.form.fields.vehicles'))
                ->options(function (Get $get) {
                    $type = $get('vehicle_type_id');
                    return EloquentVehicle::whereNotNull('code_1')
                        ->get()
                        ->mapWithKeys(fn($vehicle) => [
                            $vehicle->id => $vehicle->code_1
                        ]);
                })
                ->searchable()
                ->bulkToggleable(true)
                ->columnSpanFull()
                ->columns(10)
        ];
    }
}
